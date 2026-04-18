<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
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
        $barang = Barang::all();
        return view('peminjaman.create', compact('barang'));
    }

    /**
     * SIMPAN PEMINJAMAN
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
            'tanggal_pinjam' => Carbon::now()->toDateString(),
            'jam_pinjam' => Carbon::now()->toTimeString(),
            'status' => 'diajukan',
        ]);

        foreach ($request->barang as $item) {
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
     * APPROVE PEMINJAMAN (ADMIN)
     */
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'disetujui';
        $peminjaman->save();

        return redirect()->back();
    }

    /**
     * DIPINJAM
     */
    public function pinjam($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        return redirect()->back();
    }

    /**
     * PENGEMBALIAN + DENDA
     */
    public function pengembalian(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->tanggal_kembali = Carbon::now()->toDateString();
        $peminjaman->jam_kembali = Carbon::now()->toTimeString();
        $peminjaman->status = 'dikembalikan';
        $peminjaman->kondisi_kembali = $request->kondisi;

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

        return redirect()->back()->with('success', 'Barang dikembalikan');
    }
}