<?php

namespace App\Http\Controllers;

use App\Models\SopBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class SopBarangController extends Controller
{
    /**
     * TAMPILKAN SEMUA SOP
     */
    public function index()
    {
        // USER & ADMIN boleh lihat data
        $sop = SopBarang::with('barang')->get();

        return view('sop.index', compact('sop'));
    }

    /**
     * FORM TAMBAH SOP
     */
    public function create()
    {
        // Ambil semua data barang untuk form tambah SOP
        $barang = Barang::all();
        return view('sop.create', compact('barang'));
    }

    /**
     * SIMPAN SOP
     */
    public function store(Request $request)
    {
        // Validasi input untuk menyimpan SOP
        $request->validate([
            'barang_id' => 'required|exists:barang,id', // Pastikan barang_id ada di tabel barang
            'isi_sop' => 'required',
        ]);

        // Menyimpan SOP baru
        SopBarang::create([
            'barang_id' => $request->barang_id,
            'isi_sop' => $request->isi_sop,
        ]);

        return redirect('/sop')->with('success', 'SOP berhasil ditambahkan');
    }

    /**
     * LIHAT SOP PER BARANG
     */
    public function showByBarang($barang_id)
    {
        $barang = Barang::findOrFail($barang_id);
        $sop = SopBarang::where('barang_id', $barang_id)->get();  // Ambil SOP berdasarkan barang_id

        return view('sop.show', compact('barang', 'sop'));
    }

    /**
     * FORM EDIT SOP
     */
    public function edit($id)
    {
        $sop = SopBarang::findOrFail($id); // Ambil SOP berdasarkan ID
        $barang = Barang::all(); // Ambil semua data barang untuk dropdown

        return view('sop.edit', compact('sop', 'barang'));
    }

    /**
     * UPDATE SOP
     */
    public function update(Request $request, $id)
    {
        $sop = SopBarang::findOrFail($id);

        // Validasi input untuk update SOP
        $request->validate([
            'isi_sop' => 'required',
        ]);

        // Update SOP
        $sop->update([
            'isi_sop' => $request->isi_sop
        ]);

        return redirect('/sop')->with('success', 'SOP berhasil diupdate');
    }

    /**
     * HAPUS SOP
     */
    public function destroy($id)
    {
        SopBarang::findOrFail($id)->delete(); // Hapus data SOP

        return redirect()->back()->with('success', 'SOP berhasil dihapus');
    }
}