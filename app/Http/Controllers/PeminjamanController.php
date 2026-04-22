<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * TAMPILKAN SEMUA PEMINJAMAN
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'detail.barang')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * FORM PEMINJAMAN
     */
    public function create()
    {
        $users = User::all();
        $barang = Barang::all();

        return view('peminjaman.create', compact('users', 'barang'));
    }

    /**
     * SIMPAN PEMINJAMAN + KURANGI STOK
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang' => 'required|array',
            'barang.*.id' => 'required|exists:barang,id',
            'barang.*.jumlah' => 'required|integer|min:1',
        ]);

        $kode = 'PMJ-' . date('Ymd') . '-' . rand(100, 999);

        $peminjaman = Peminjaman::create([
            'kode_transaksi' => $kode,
            'user_id' => $request->user_id,
            'tanggal_pinjam' => now()->toDateString(),
            'jam_pinjam' => now()->toTimeString(),
            'status' => 'diajukan',
        ]);

        foreach ($request->barang as $item) {
            $barang = Barang::findOrFail($item['id']);

            // CEK STOK
            if ($barang->stok < $item['jumlah']) {
                return back()->with('error', 'Stok ' . $barang->nama_barang . ' tidak cukup');
            }

            // KURANGI STOK
            $barang->stok -= $item['jumlah'];
            $barang->save();

            // SIMPAN DETAIL
            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'barang_id' => $item['id'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil dibuat');
    }

    /**
     * DETAIL PEMINJAMAN
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'detail.barang')->findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::with('detail.barang')->findOrFail($id);
        $users = User::all();

        return view('peminjaman.edit', compact('peminjaman', 'users'));
    }

    /**
     * UPDATE (AMAN)
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:diajukan,disetujui,ditolak,dipinjam,dikembalikan',
        ]);

        $peminjaman->update([
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);

        return redirect('/peminjaman')->with('success', 'Peminjaman diupdate');
    }

    /**
     * APPROVE
     */
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status != 'diajukan') {
            return back()->with('error', 'Status tidak valid');
        }

        $peminjaman->status = 'disetujui';
        $peminjaman->save();

        return back();
    }

    /**
     * DIPINJAM
     */
    public function pinjam($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status != 'disetujui') {
            return back()->with('error', 'Harus disetujui dulu');
        }

        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        return back();
    }

    /**
     * PENGEMBALIAN + DENDA
     */
    public function pengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status != 'dipinjam') {
            return back()->with('error', 'Barang belum dipinjam');
        }

        $peminjaman->tanggal_kembali = now()->toDateString();
        $peminjaman->jam_kembali = now()->toTimeString();
        $peminjaman->status = 'dikembalikan';
        $peminjaman->kondisi_kembali = $request->kondisi;

        // DENDA
        $denda = 0;

        if ($request->kondisi == 'rusak ringan') {
            $denda = 50000;
        } elseif ($request->kondisi == 'rusak berat') {
            $denda = 150000;
        } elseif ($request->kondisi == 'hilang') {
            $denda = 500000;
        }

        $peminjaman->denda = $denda;
        $peminjaman->save();

        return back()->with('success', 'Barang dikembalikan');
    }
}