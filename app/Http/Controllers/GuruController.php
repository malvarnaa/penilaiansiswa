<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\UploadGuru;
use App\Models\User;
use App\Models\Mapel;
use App\Models\UploadAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class GuruController extends Controller
{

    public function index()
    {
        $title = 'Data Guru';
        $mapels = Mapel::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $gurus = Guru::with('mapel')->get();

        return view('guru.dataguru', compact('title', 'gurus', 'mapels', 'kelas', 'jurusan'));
    }

    public function create()
    {
        $mapels = Mapel::all(); // Ambil semua mata pelajaran untuk dropdown
        return view('guru.createdata', compact('mapels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|unique:gurus,nomor',
            'jk' => 'required|string|max:100',
            'jurusan_id' => 'required|array', 
            'jurusan_id.*' => 'exists:jurusan,id', 
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id',
            'mapel_id' => 'required|array',
            'mapel_id.*' => 'exists:mapels,id',
        ], [
            'nomor.unique' => 'NIP/NUPTK sudah dimiliki oleh guru lain.',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'username' => $request->nomor,
            'role' => 'guru',
            'password' => Hash::make('12345678'),
        ]);

        $guru = Guru::create([
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'jk' => $request->jk,
            'user_id' => $user->id,
        ]);

        foreach ($request->jurusan_id as $index => $jurusanId) {
            $guru->mapel()->attach($request->mapel_id[$index], [
                'jurusan_id' => $jurusanId,
                'kelas_id' => $request->kelas_id[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Data guru berhasil ditambahkan');
    }

    




    public function uploadTP(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:5120', 
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('pdfs', $fileName, 'public'); 

        UploadGuru::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'status' => 'pending', 
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tp.hasilunduhan')->with('success', 'File berhasil di-upload dan menunggu review.');
    }

    public function hasilUnduhan()
    {
        $uploads = UploadGuru::where('user_id', auth()->id())->get(); 

        return view('tp.hasilunduhan', compact('uploads'));
    }

    public function destroyTP($id)
    {
        // Find the upload by its ID
        $upload = UploadGuru::findOrFail($id);

        // Delete the file from the storage
        if (Storage::disk('public')->exists($upload->file_path)) {
            Storage::disk('public')->delete($upload->file_path);
        }

        // Delete the record from the database
        $upload->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }



    public function showGuru($guruId)
    {
        $guru = Guru::with(['user', 'mapel', 'kelas'])->find($guruId);
        return view('guru.showguru', compact('guru'));
    }

    public function showDashboard()
    {
        // Ambil data user yang sedang login
        $guru = Auth::user()->guru;  // Mengambil data guru terkait dengan user yang login

        return view('guru.showguru', compact('guru'));
    }

    public function edit($id)
    {
        $gurus = Guru::with('guru_mapel')->get();
        $guru = Guru::with('mapel')->findOrFail($id);
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
    
        return response()->json([
            'guru_mapel' => $guru->mapel->map(function ($mapel) {
                return [
                    'jurusan_id' => $mapel->pivot->jurusan_id,
                    'kelas_id' => $mapel->pivot->kelas_id,
                    'mapel_id' => $mapel->id,
                ];
            }),
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            'mapel' => $mapel,
        ]);
    }
    
    public function update(Request $request, $id)
{
    // Validasi Input
    $request->validate([
        'nama' => 'required|string|max:255',
        'nomor' => 'required|string|unique:gurus,nomor,' . $id,
        'jk' => 'required|string|max:100',

        'jurusan_id' => 'nullable|array|min:1',
        'jurusan_id.*' => 'integer|exists:jurusan,id',

        'kelas_id' => 'nullable|array|min:1',
        'kelas_id.*' => 'integer|exists:kelas,id',

        'mapel_id' => 'nullable|array|min:1',
        'mapel_id.*' => 'integer|exists:mapels,id',
    ]);

    // Ambil Data Guru
    $guru = Guru::findOrFail($id);
    $guru->update([
        'nama' => $request->nama,
        'nomor' => $request->nomor,
        'jk' => $request->jk,
    ]);

    // Jika jurusan_id, kelas_id, dan mapel_id kosong, jangan update
    if ($request->has('jurusan_id') && $request->has('kelas_id') && $request->has('mapel_id')) {
        $syncData = [];
        foreach ($request->jurusan_id as $index => $jurusanId) {
            if (isset($request->mapel_id[$index]) && isset($request->kelas_id[$index])) {
                $syncData[$request->mapel_id[$index]] = [
                    'jurusan_id' => $jurusanId,
                    'kelas_id' => $request->kelas_id[$index],
                ];
            }
        }

        // Sync Relasi Many-to-Many
        $guru->mapel()->sync($syncData);
    }

    return redirect()->back()->with('success', 'Data guru berhasil diperbarui');
}



    public function showUploads()
    {
        // Cek apakah user memiliki role guru
        if (auth()->user()->role != 'guru') {
            return redirect()->route('home');
        }

        $uploads = UploadAdmin::all(); // Ambil semua upload PDF yang ada

        return view('guru.uploads', compact('uploads'));
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        User::destroy($guru->user_id);

        $guru->delete();

        return redirect()->back()->with('success', 'Data guru berhasil dihapus');
    }

    public function getKelasMapel($jurusan_id)
    {
        $kelas = Kelas::where('jurusan_id', $jurusan_id)->get();
        $mapel = Mapel::where('jurusan_id', $jurusan_id)->get();

        return response()->json([
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }


}
