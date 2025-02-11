<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $judul = 'Data Kelas';
        $jurusanId = $request->jurusan_id;
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        return view('kelas.index', compact('judul', 'kelas', 'jurusans', 'jurusanId'));
    }

    public function indexAll()
    {
        $kelas = Kelas::with('jurusan')->get(); // Semua kelas tanpa filter
        return view('kelas.showallkelas', compact('kelas'));
    }

    public function store(Request $request, $kelas)
    {
        // Validasi input
        $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'kode_jurusan' => 'required|string:kode_jurusan,id',
            'no_jrs' => 'required|integer',
        ]);

        // Cek apakah kelas dengan kombinasi jurusan dan no_jrs sudah ada
        $existingClass = Kelas::where('kelas', $kelas)
            ->where('jurusan_id', $request->jurusan_id)
            ->where('no_jrs', $request->no_jrs)
            ->first();

        if ($existingClass) {
            return redirect()->back()->with('error', 'Kelas sudah ada.')->withInput();
        }

        // Ambil data jurusan
        $jurusan = Jurusan::findOrFail($request->jurusan_id);

        Kelas::create([
            'kelas' => $kelas,
            'no_jrs' => $request->no_jrs,
            'jurusan_id' => $request->jurusan_id,
            'kode_jurusan' => $request->kode_jurusan,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('kelas.create', compact('jurusans'));
    }

    public function showKelas($kelas)
    {
        $kelasData = Kelas::where('kelas', $kelas)->with('jurusan')->get();
        $jurusans = Jurusan::all();
        return view('kelas.showkelas', compact('kelas', 'kelasData', 'jurusans'));
    }

    public function showSiswa($kelas)
    {
        $kelasData = Kelas::findOrFail($kelas);    
        $siswaData = Siswa::where('kelas_id', $kelasData->id)->get(); // Pastikan menggunakan kelas_id
    
        return view('kelas.showSiswa', compact('kelasData', 'siswaData'));
    }
}
