<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if (auth()->user()->role == 'admin') {

            $peminjaman = Peminjaman::with('user', 'detail.barang')
                ->latest()
                ->get();

        } else {

            $peminjaman = Peminjaman::with('user', 'detail.barang')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('peminjaman.index', compact('peminjaman'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        if (auth()->user()->role != 'user') {
            abort(403, 'Hanya user yang bisa meminjam');
        }

        $barang = Barang::all();

        return view('peminjaman.create', compact('barang'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */
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

            /*
            |--------------------------------------------------------------------------
            | SIMPAN PEMINJAMAN
            |--------------------------------------------------------------------------
            */
            $waktuPinjam = now();
            $deadline = $waktuPinjam->copy()->addHours(4)->addMinutes(30);
            $peminjaman = Peminjaman::create([
                'kode_transaksi' => $kode,
                'user_id' => auth()->id(),

                'tanggal_pinjam' => $waktuPinjam->toDateString(),
                'jam_pinjam' => $waktuPinjam->format('H:i:s'),

                'tanggal_deadline' => $deadline->toDateString(),
                'jam_deadline' => $deadline->format('H:i:s'),

                'status' => 'diajukan',
            ]);

            /*
            |--------------------------------------------------------------------------
            | DETAIL PEMINJAMAN
            |--------------------------------------------------------------------------
            */
            foreach ($request->barang as $item) {

                $barang = Barang::findOrFail($item['id']);

                if ($item['jumlah'] > $barang->stok) {

                    DB::rollBack();

                    return back()
                     ->withInput()
                    ->with(
                            'error',
                             'Stok '.$barang->nama_barang.
                            ' hanya tersedia '.$barang->stok
                             );
                }

                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id' => $item['id'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            DB::commit();

            return redirect('/peminjaman')
                ->with('success', 'Pengembalian berhasil dilakukan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'detail.barang')
            ->findOrFail($id);

        return view('peminjaman.show', compact('peminjaman'));
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE PEMINJAMAN
    |--------------------------------------------------------------------------
    */
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('detail.barang')
            ->findOrFail($id);

        if ($peminjaman->status != 'diajukan') {

            return back()->with('error', 'Status tidak valid');
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | CEK & KURANGI STOK
            |--------------------------------------------------------------------------
            */
            foreach ($peminjaman->detail as $d) {

                $barang = Barang::findOrFail($d->barang_id);

                if ($barang->stok < $d->jumlah) {

                    throw new \Exception(
                        'Stok ' . $barang->nama_barang . ' tidak cukup'
                    );
                }

                $barang->stok -= $d->jumlah;

                $barang->save();
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS
            |--------------------------------------------------------------------------
            */
            $peminjaman->update([
                'status' => 'dipinjam'
            ]);

            DB::commit();

            return back()->with('success', 'Peminjaman disetujui');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | USER AJUKAN PENGEMBALIAN
    |--------------------------------------------------------------------------
    */
    public function ajukanPengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->user_id != auth()->id()) {

            return back()->with('error', 'Akses ditolak');
        }

        if ($peminjaman->status != 'dipinjam') {

            return back()->with('error', 'Barang belum dipinjam');
        }

        $peminjaman->update([
            'status' => 'menunggu_verifikasi',
            'kondisi_kembali' => $request->kondisi
        ]);

        return back()->with(
            'success',
            'Pengembalian diajukan'
        );
    }
    
    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI PENGEMBALIAN
    |--------------------------------------------------------------------------
    */
    public function pengembalian(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable'
        ]);

        $peminjaman = Peminjaman::with('detail')
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | STATUS HARUS MENUNGGU VERIFIKASI
        |--------------------------------------------------------------------------
        */
        if ($peminjaman->status != 'menunggu_verifikasi') {

            return back()->with(
                'error',
                'Pengembalian belum diajukan user'
            );
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | KEMBALIKAN STOK
            |--------------------------------------------------------------------------
            */
            foreach ($peminjaman->detail as $d) {

                $barang = Barang::find($d->barang_id);

                $barang->stok += $d->jumlah;

                $barang->save();
            }

            /*
            |--------------------------------------------------------------------------
            | AMBIL KONDISI DARI USER
            |--------------------------------------------------------------------------
            */
            $kondisi = $peminjaman->kondisi_kembali;

            /*
            |--------------------------------------------------------------------------
            | HITUNG DENDA
            |--------------------------------------------------------------------------
            */
            $denda = 0;

            if ($kondisi == 'rusak ringan') {

                $denda = 50000;
            }

            elseif ($kondisi == 'rusak berat') {

                $denda = 150000;
            }

            elseif ($kondisi == 'hilang') {

                $denda = 500000;
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA
            |--------------------------------------------------------------------------
            */
            $peminjaman->update([

                'tanggal_kembali' => now()->toDateString(),

                'jam_kembali' => now()->toTimeString(),

                'status' => 'dikembalikan',

                'denda' => $denda,

                'catatan_admin' => $request->catatan_admin,
            ]);

            DB::commit();

            return back()->with(
                'success',
                'Barang berhasil diverifikasi'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal verifikasi pengembalian'
            );
        }
    }
   public function destroy($id)
{
    $peminjaman = Peminjaman::with('detail')
                    ->findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    if (auth()->user()->role === 'user') {

        if ($peminjaman->status !== 'diajukan') {

            return back()->with(
                'error',
                'Hanya peminjaman berstatus diajukan yang dapat dihapus.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    else {

        // hanya boleh hapus miliknya sendiri
        if ($peminjaman->user_id != auth()->id()) {

            abort(403, 'Akses ditolak.');
        }

        // hanya boleh hapus saat diajukan
        if ($peminjaman->status !== 'diajukan') {

            return back()->with(
                'error',
                'Peminjaman yang sudah diproses tidak dapat dihapus.'
            );
        }
    }

    DB::beginTransaction();

    try {

        foreach ($peminjaman->detail as $d) {

            $d->delete();
        }

        $peminjaman->delete();

        DB::commit();

        return back()->with(
            'success',
            'Data peminjaman berhasil dihapus.'
        );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            'Gagal menghapus data: ' . $e->getMessage()
        );
    }
}

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('detail.barang')
                        ->findOrFail($id);

        $barang = Barang::all();

            if ($peminjaman->status !== 'diajukan') {

                return redirect('/peminjaman')
                    ->with(
                        'error',
                        'Hanya peminjaman berstatus diajukan yang dapat diedit.'
                    );
            }

        return view('peminjaman.edit', compact(
            'peminjaman',
            'barang'
        ));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'barang' => 'required|array',
            'barang.*.id' => 'required|exists:barang,id',
            'barang.*.jumlah' => 'required|integer|min:1',
        ]);

        $peminjaman = Peminjaman::with('detail')
                        ->findOrFail($id);

        if (
            auth()->user()->role === 'user' &&
            $peminjaman->user_id != auth()->id()
        ) {
            abort(403);
        }

        if ($peminjaman->status !== 'diajukan') {
            return back()->with(
                'error',
                'Hanya peminjaman berstatus diajukan yang dapat diedit.'
            );
        }

        DB::beginTransaction();

        try {

            // cek stok dulu
            foreach ($request->barang as $item) {

                $barang = Barang::findOrFail($item['id']);

                if ($item['jumlah'] > $barang->stok) {

                    throw new \Exception(
                        'Jumlah pinjam ' .
                        $barang->nama_barang .
                        ' melebihi stok tersedia (' .
                        $barang->stok .
                        ')'
                    );
                }
            }

            // hapus detail lama
            $peminjaman->detail()->delete();

            // simpan detail baru
            foreach ($request->barang as $item) {

                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id' => $item['id'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            DB::commit();

            return redirect('/peminjaman')
                ->with(
                    'success',
                    'Peminjaman berhasil diperbarui'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}
