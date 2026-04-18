<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * TAMPILKAN SEMUA BARANG
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    /**
     * FORM TAMBAH BARANG
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * SIMPAN BARANG
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barang',
            'kategori' => 'required|in:alat,bahan',
            'satuan' => 'required|in:pcs,gram,ml',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required',
            'lokasi' => 'required',
        ]);

        Barang::create($request->all());

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * DETAIL BARANG
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    /**
     * FORM EDIT BARANG
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * UPDATE BARANG
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id,
            'kategori' => 'required|in:alat,bahan',
            'satuan' => 'required|in:pcs,gram,ml',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required',
            'lokasi' => 'required',
        ]);

        $barang->update($request->all());

     return redirect('/barang')->with('success', 'Barang berhasil diupdate');
    }
    /**
     * HAPUS BARANG
     */
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect('/barang')->with('success', 'Barang berhasil dihapus');
    }
}