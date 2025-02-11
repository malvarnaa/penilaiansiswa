<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
    $jurusanId = $request->jurusan_id;

    // Ambil semua jurusan untuk dropdown filter
    $jurusans = Jurusan::all();

    // Filter dan kelompokkan mata pelajaran berdasarkan jurusan
    $mapel = Mapel::when($jurusanId, function ($query) use ($jurusanId) {
        return $query->where('jurusan_id', $jurusanId);
    })
    ->with(['jurusan', 'guru.kelas']) // Include relasi jurusan, guru, dan kelas
    ->get()
    ->groupBy('mapel'); // Kelompokkan berdasarkan nama mapel

    $judul = 'Mata Pelajaran';

    return view('mapel.index', compact('mapel', 'jurusans', 'jurusanId', 'judul'));
    }


    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required|string|max:255',
            'jurusan_id' => 'required|array', // Pastikan jurusan_id adalah array
            'jurusan_id.*' => 'exists:jurusan,id', // Validasi setiap jurusan_id
        ]);
    
        // Simpan mapel untuk setiap jurusan yang dipilih
        foreach ($request->jurusan_id as $jurusanId) {
            Mapel::create([
                'mapel' => $request->mapel,
                'jurusan_id' => $jurusanId,
            ]);
        }
    
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan ke jurusan yang dipilih.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function showGuru(Request $request, $mapel)
    {
        $jurusanId = $request->get('jurusan_id');
    
        $mapel = Mapel::where('mapel', $mapel)->firstOrFail();
    
        if ($jurusanId) {
            $gurus = $mapel->guru()
                ->whereHas('mapel', function ($query) use ($jurusanId) {
                    $query->where('kelas_id', $jurusanId);
                })
                ->get();
        } else {
            $gurus = $mapel->guru()->with('kelas')->get();
        }
    
        return view('mapel.showguru', compact('mapel', 'gurus', 'jurusanId'));
    }
    
    
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        //
    }


    public function jurusanIndex() {
        $jurusans = Jurusan::all();
        return view('admin.konke', compact('jurusans'));
    }

    public function jurusanStore(Request $request) {
        $request->validate([
            'jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'nullable|array', // Validasi untuk menerima array kode_jurusan
            'kode_jurusan.*' => 'nullable|string|max:255', // Validasi tiap item dalam array
        ]);

        // Menggabungkan kode_jurusan menjadi satu string dengan koma
        $kodeJurusan = implode(',', array_map('trim', $request->kode_jurusan));

        Jurusan::create([
            'jurusan' => $request->jurusan,
            'kode_jurusan' => $kodeJurusan, // Menyimpan kode jurusan sebagai string dengan koma
        ]);

        return redirect()->back()->with('Jurusan berhasil ditambahkan.');
    }

    public function jurusanEdit(Jurusan $jurusan) {
        $jurusan = Jurusan::all();
        return view('jurusan.edit', compact('jurusan'));
    }

    public function jurusanUpdate(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'nullable|array', 
            'kode_jurusan.*' => 'nullable|string|max:255', 
        ]);

        // Menggabungkan kode_jurusan menjadi satu string dengan koma jika ada
        $kodeJurusan = $request->kode_jurusan ? implode(',', array_map('trim', $request->kode_jurusan)) : null;

        $jurusan->update([
            'jurusan' => $request->jurusan,
            'kode_jurusan' => $kodeJurusan, // Simpan kode jurusan dalam format string dengan koma
        ]);

        return redirect()->back()->with('success', 'Jurusan berhasil diperbarui.');
    }


    public function jurusanDestroy($id) {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }

    public function jurusanCreate() {
        return view('mapel.jurusanCreate');
    }
}
