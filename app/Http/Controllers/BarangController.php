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
     * FORM TAMBAH BARANG (ADMIN SAJA)
     */
    public function create()
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }

        return view('barang.create');
    }

    /**
     * SIMPAN BARANG (ADMIN SAJA)
     */
    public function store(Request $request)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barang,kode_barang',
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
     * DETAIL BARANG (SEMUA BOLEH)
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    /**
     * FORM EDIT BARANG (ADMIN SAJA)
     */
    public function edit($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }

        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * UPDATE BARANG (ADMIN SAJA)
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }

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
     * HAPUS BARANG (ADMIN SAJA)
     */
    public function destroy($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }

        Barang::findOrFail($id)->delete();

        return redirect('/barang')->with('success', 'Barang berhasil dihapus');
    }
}