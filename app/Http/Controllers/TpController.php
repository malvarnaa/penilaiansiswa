<?php

namespace App\Http\Controllers;

use App\Models\Tp;
use App\Models\UploadAdmin; // Ambil semua upload PDF yang ada
;
use Illuminate\Http\Request;

class TpController extends Controller
{
    public function index() {
        $judul = 'Tujuan Pembelajaran';
        $tp = Tp::all();
        return view('tp.index', compact('judul', 'tp'));
    }

    public function hasilunduhan() {
        $judul = 'Unduh Tuuan Pembelajaran';
        $uploads = UploadAdmin::all(); // Ambil semua upload PDF yang ada

        return view('tp.hasilunduhan', compact('judul', 'uploads'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_tp' => 'required|string|max:255',
        ]);

        $akhirTp = Tp::latest()->first(); // Ambil data terakhir berdasarkan ID
        $kode = $akhirTp ? intval(substr($akhirTp->no_tp, 3)) + 1 : 1;
    
        // Format nomor menjadi 'TP 01', 'TP 02', dst.
        $noTp = 'TP ' . str_pad($kode, 2, '0', STR_PAD_LEFT);
    
        // Simpan data ke database
        Tp::create([
            'no_tp' => $noTp,
            'nama_tp' => $request->nama_tp,
        ]);

        return redirect()->back()->with('Tujuan Pembelajaran berhasil ditambahkan.');
    }

    public function downloadBlanko()
    {
        $filePath = public_path('files/blanko_tujuan_pembelajaran.pdf'); // Lokasi file PDF
        $fileName = 'blanko_tujuan_pembelajaran.pdf';

        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName);
        }

        return back()->with('error', 'File blanko tidak ditemukan.');
    }
}
