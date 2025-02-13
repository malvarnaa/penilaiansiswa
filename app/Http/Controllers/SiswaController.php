<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Siswa';
        $kelas = Kelas::all();
        $datasiswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('datasiswa', 'kelas', 'judul'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis.*' => 'required|unique:siswas,nis|unique:users,username',
            'nama.*' => 'required',
            'jk.*' => 'required|in:Laki-laki,Perempuan',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
        ], [
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
        ]);

        // Buat akun user dengan username = nis
        $user = User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'password' => Hash::make('12345678'),
            'role' => 'siswa',
        ]);

        // Simpan siswa
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('kelas.siswa', $request->kelas_id)->with('success', 'Data siswa berhasil ditambahkan.');

    }
    




    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $request->validate([
        'nis' => [
            'required',
            Rule::unique('siswas', 'nis')->ignore($siswa->id), // Abaikan validasi jika NIS tidak berubah
            Rule::unique('users', 'username')->ignore($siswa->user_id), // Pastikan username user juga diabaikan jika tidak berubah
        ],
        'nama' => 'required',
        'jk' => 'required|in:Laki-laki,Perempuan',
        'kelas_id' => 'required|exists:kelas,id',
        'jurusan_id' => 'required|exists:jurusan,id',
    ], [
        'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
    ]);

    // Update user account jika NIS berubah
    $user = User::findOrFail($siswa->user_id);
    if ($user->username !== $request->nis) {
        $user->update(['username' => $request->nis]);
    }

    // Update siswa
    $siswa->update([
        'nis' => $request->nis,
        'nama' => $request->nama,
        'jk' => $request->jk,
        'kelas_id' => $request->kelas_id,
        'jurusan_id' => $request->jurusan_id,
    ]);

    return redirect()->route('kelas.siswa', $request->kelas_id)->with('success', 'Data siswa berhasil diperbarui.');
}



    public function destroy(Siswa $siswa)
    {
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        if ($siswa->user) {
            $siswa->user->delete();
        }

        $siswa->delete();
        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    }
}