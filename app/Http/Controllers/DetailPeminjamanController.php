<?php

namespace App\Http\Controllers;

use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DetailPeminjamanController extends Controller
{
    // public function __construct()
    // {
    //     // Pastikan user sudah login
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // Menampilkan semua detail peminjaman
        // Admin dan User dapat mengakses data ini
        $detail = DetailPeminjaman::with('peminjaman', 'barang')->get();
        return view('detail_peminjaman.index', compact('detail'));
    }

    public function create()
    {
        // Hanya admin yang bisa mengakses halaman tambah detail
        if (auth()->user()->role != 'admin') {
            return redirect('/detail-peminjaman')->with('error', 'Akses ditolak');
        }

        $peminjaman = Peminjaman::all();
        return view('detail_peminjaman.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk menyimpan data peminjaman
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        DetailPeminjaman::create($request->all());

        return redirect('/detail-peminjaman')->with('success', 'Detail berhasil ditambahkan');
    }

    public function byPeminjaman($id)
    {
        // Admin dan user bisa melihat detail peminjaman berdasarkan id
        $peminjaman = Peminjaman::findOrFail($id);
        $detail = DetailPeminjaman::where('peminjaman_id', $id)->get();

        return view('detail_peminjaman.show', compact('peminjaman', 'detail'));
    }

    public function edit($id)
    {
        // Hanya admin yang bisa mengedit
        if (auth()->user()->role != 'admin') {
            return redirect('/detail-peminjaman')->with('error', 'Akses ditolak');
        }

        $detail = DetailPeminjaman::findOrFail($id);
        return view('detail_peminjaman.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        // Hanya admin yang bisa mengupdate detail peminjaman
        if (auth()->user()->role != 'admin') {
            return redirect('/detail-peminjaman')->with('error', 'Akses ditolak');
        }

        $detail = DetailPeminjaman::findOrFail($id);

        // Validasi input jumlah barang
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $detail->update([
            'jumlah' => $request->jumlah
        ]);

        return redirect('/detail-peminjaman')->with('success', 'Detail berhasil diupdate');
    }

    public function destroy($id)
    {
        // Hanya admin yang bisa menghapus detail peminjaman
        if (auth()->user()->role != 'admin') {
            return redirect('/detail-peminjaman')->with('error', 'Akses ditolak');
        }

        DetailPeminjaman::findOrFail($id)->delete();
        return back()->with('success', 'Detail berhasil dihapus');
    }
}