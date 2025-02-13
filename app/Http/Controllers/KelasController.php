<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mapel;
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

    public function showKelas($identifier)
{
    $user = auth()->user();

    // Cek apakah parameter adalah angka (mapel_id) atau nama kelas
    if (is_numeric($identifier)) {
        // Jika identifier berupa angka, anggap sebagai mapel_id
        $mapel_id = $identifier;

        if ($user->role === 'admin') {
            // Admin melihat semua kelas yang memiliki mapel tersebut
            $kelasData = Kelas::whereHas('guruMapel', function ($query) use ($mapel_id) {
                $query->where('mapel_id', $mapel_id);
            })->with('jurusan', 'siswa')->get();

            $jurusans = Jurusan::all();
        } else {
            // Guru hanya melihat kelas yang dia ajar berdasarkan mapel
            $kelasData = Kelas::whereHas('guruMapel', function ($query) use ($user, $mapel_id) {
                $query->where('guru_id', $user->guru->id)
                      ->where('mapel_id', $mapel_id);
            })->with('jurusan', 'siswa')->get();

            $jurusans = [];
        }

        // Ambil nama mata pelajaran berdasarkan ID
        $kelas = Mapel::find($mapel_id)->mapel ?? 'Tidak Ditemukan';

        return view('kelas.showkelas', compact('kelasData', 'mapel_id', 'jurusans', 'kelas'));
    } else {
        // Jika identifier bukan angka, anggap sebagai nama kelas
        $kelas = $identifier;
        $kelasData = Kelas::where('kelas', $kelas)->with('jurusan', 'siswa')->get();
        $jurusans = Jurusan::all();

        return view('kelas.showkelas', compact('kelasData', 'jurusans', 'kelas')); // Hapus $mapel_id karena tidak diperlukan
    }
}

    public function showSiswa($kelas)
    {
        $kelasData = Kelas::findOrFail($kelas);
        $siswaData = Siswa::where('kelas_id', $kelasData->id)->get();
        
        $jurusanData = Jurusan::findOrFail($kelasData->jurusan_id);    
        return view('kelas.showSiswa', compact('kelasData', 'siswaData', 'jurusanData'));
    }
}

