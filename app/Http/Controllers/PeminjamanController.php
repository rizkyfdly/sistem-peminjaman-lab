<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $peminjaman = Peminjaman::with('user', 'detail.barang')->get();
        } else {
            $peminjaman = Peminjaman::with('detail.barang')
                ->where('user_id', auth()->id())
                ->get();
        }

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        if (auth()->user()->role != 'user') {
            abort(403, 'Hanya user yang bisa meminjam');
        }

        $barang = Barang::all();
        return view('peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang' => 'required|array',
            'barang.*.id' => 'required|exists:barang,id',
            'barang.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $kode = 'PMJ-' . date('Ymd') . '-' . rand(100, 999);

            $peminjaman = Peminjaman::create([
                'kode_transaksi' => $kode,
                'user_id' => auth()->id(),
                'tanggal_pinjam' => now()->toDateString(),
                'jam_pinjam' => now()->toTimeString(),
                'status' => 'diajukan',
            ]);

            foreach ($request->barang as $item) {
                $barang = Barang::findOrFail($item['id']);

                if ($barang->stok < $item['jumlah']) {
                    throw new \Exception('Stok ' . $barang->nama_barang . ' tidak cukup');
                }

                $barang->stok -= $item['jumlah'];
                $barang->save();

                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id' => $item['id'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            DB::commit();

            return redirect('/peminjaman')->with('success', 'Peminjaman berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'detail.barang')->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status != 'diajukan') {
            return back()->with('error', 'Status tidak valid');
        }

        $peminjaman->update(['status' => 'disetujui']);
        return back();
    }

    public function pinjam($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status != 'disetujui') {
            return back()->with('error', 'Harus disetujui dulu');
        }

        $peminjaman->update(['status' => 'dipinjam']);
        return back();
    }

    public function pengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required'
        ]);

        $peminjaman = Peminjaman::with('detail')->findOrFail($id);

        if ($peminjaman->status != 'dipinjam') {
            return back()->with('error', 'Barang belum dipinjam');
        }

        DB::beginTransaction();

        try {
            // KEMBALIKAN STOK
            foreach ($peminjaman->detail as $d) {
                $barang = Barang::find($d->barang_id);
                $barang->stok += $d->jumlah;
                $barang->save();
            }

            $denda = 0;

            if ($request->kondisi == 'rusak ringan') $denda = 50000;
            elseif ($request->kondisi == 'rusak berat') $denda = 150000;
            elseif ($request->kondisi == 'hilang') $denda = 500000;

            $peminjaman->update([
                'tanggal_kembali' => now()->toDateString(),
                'jam_kembali' => now()->toTimeString(),
                'status' => 'dikembalikan',
                'kondisi_kembali' => $request->kondisi,
                'denda' => $denda,
            ]);

            DB::commit();

            return back()->with('success', 'Barang dikembalikan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal pengembalian');
        }
    }
}