<?php

namespace App\Http\Controllers;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class DetailPeminjamanController extends Controller
{
    /**
     * TAMPILKAN SEMUA DETAIL PEMINJAMAN
     */
    public function index()
    {
        $detail = DetailPeminjaman::with('peminjaman', 'barang')->get();
        return view('detail_peminjaman.index', compact('detail'));
    }

    /**
     * FORM TAMBAH DETAIL (OPSIONAL MANUAL)
     */
    public function create()
    {
        $peminjaman = Peminjaman::all();
        $barang = Barang::all();

        return view('detail_peminjaman.create', compact('peminjaman', 'barang'));
    }

    /**
     * SIMPAN DETAIL PEMINJAMAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        DetailPeminjaman::create([
            'peminjaman_id' => $request->peminjaman_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/detail-peminjaman')->with('success', 'Detail berhasil ditambahkan');
    }

    /**
     * LIHAT DETAIL PER PEMINJAMAN
     */
    public function byPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $detail = DetailPeminjaman::with('barang')
            ->where('peminjaman_id', $id)
            ->get();

        return view('detail_peminjaman.show', compact('peminjaman', 'detail'));
    }

    /**
     * EDIT DETAIL
     */
    public function edit($id)
    {
        $detail = DetailPeminjaman::findOrFail($id);
        $barang = Barang::all();

        return view('detail_peminjaman.edit', compact('detail', 'barang'));
    }

    /**
     * UPDATE DETAIL
     */
    public function update(Request $request, $id)
    {
        $detail = DetailPeminjaman::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $detail->update([
            'jumlah' => $request->jumlah
        ]);

        return redirect('/detail-peminjaman')->with('success', 'Detail berhasil diupdate');
    }

    /**
     * HAPUS DETAIL
     */
    public function destroy($id)
    {
        DetailPeminjaman::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Detail berhasil dihapus');
    }
}