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
        $sop = SopBarang::with('barang')->get();
        return view('sop.index', compact('sop'));
    }

    /**
     * FORM TAMBAH SOP
     */
    public function create()
    {
        $barang = Barang::all();
        return view('sop.create', compact('barang'));
    }

    /**
     * SIMPAN SOP
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'isi_sop' => 'required',
        ]);

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
        $sop = SopBarang::where('barang_id', $barang_id)->get();

        return view('sop.show', compact('barang', 'sop'));
    }

    /**
     * FORM EDIT SOP
     */
    public function edit($id)
    {
        $sop = SopBarang::findOrFail($id);
        $barang = Barang::all();

        return view('sop.edit', compact('sop', 'barang'));
    }

    /**
     * UPDATE SOP
     */
    public function update(Request $request, $id)
    {
        $sop = SopBarang::findOrFail($id);

        $request->validate([
            'isi_sop' => 'required',
        ]);

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
        SopBarang::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'SOP berhasil dihapus');
    }
}