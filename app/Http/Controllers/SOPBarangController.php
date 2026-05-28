<?php

namespace App\Http\Controllers;

use App\Models\SopBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class SopBarangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN SEMUA SOP
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $sop = SopBarang::with('barang')->get();

        return view('sop.index', compact('sop'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH SOP
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $barang = Barang::all();

        return view('sop.create', compact('barang'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN SOP
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'judul_sop' => 'required',
            'langkah'   => 'required',
        ]);

        // GABUNGKAN SEMUA INPUT MENJADI 1 SOP
        $isi_sop =

        "JUDUL SOP:\n".
        $request->judul_sop."\n\n".

        "LANGKAH-LANGKAH:\n".
        $request->langkah."\n\n".

        "CATATAN:\n".
        ($request->catatan ?? '-')."\n\n".

        "PERINGATAN:\n".
        ($request->peringatan ?? '-');

        SopBarang::create([
            'barang_id' => $request->barang_id,
            'isi_sop'   => $isi_sop,
        ]);

        return redirect()
            ->route('admin.sop.index')
            ->with('success', 'SOP berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | SOP BERDASARKAN BARANG
    |--------------------------------------------------------------------------
    */
    public function showByBarang($barang_id)
    {
        $barang = Barang::findOrFail($barang_id);

        $sop = SopBarang::where('barang_id', $barang_id)->get();

        return view('sop.show', compact('barang', 'sop'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT SOP
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $sop = SopBarang::findOrFail($id);

        // PECAH ISI SOP
        $parts = explode("\n\n", $sop->isi_sop);

        $judul = str_replace("JUDUL SOP:\n", "", $parts[0] ?? '');

        $langkah = str_replace("LANGKAH-LANGKAH:\n", "", $parts[1] ?? '');

        $catatan = str_replace("CATATAN:\n", "", $parts[2] ?? '');

        $peringatan = str_replace("PERINGATAN:\n", "", $parts[3] ?? '');

        $barang = Barang::all();

        return view(
            'sop.edit',
            compact(
                'sop',
                'barang',
                'judul',
                'langkah',
                'catatan',
                'peringatan'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE SOP
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $sop = SopBarang::findOrFail($id);

        $request->validate([
            'judul_sop' => 'required',
            'langkah'   => 'required',
        ]);

        // GABUNGKAN ULANG SOP
        $isi_sop =

        "JUDUL SOP:\n".
        $request->judul_sop."\n\n".

        "LANGKAH-LANGKAH:\n".
        $request->langkah."\n\n".

        "CATATAN:\n".
        ($request->catatan ?? '-')."\n\n".

        "PERINGATAN:\n".
        ($request->peringatan ?? '-');

        $sop->update([
            'isi_sop' => $isi_sop
        ]);

        return redirect()
            ->route('admin.sop.index')
            ->with('success', 'SOP berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS SOP
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        SopBarang::findOrFail($id)->delete();

        return redirect()
            ->route('admin.sop.index')
            ->with('success', 'SOP berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL SOP
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $sop = SopBarang::with('barang')->findOrFail($id);

        $barang = $sop->barang;

        return view('sop.show', compact('sop', 'barang'));
    }
}