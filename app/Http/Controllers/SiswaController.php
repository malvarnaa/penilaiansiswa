<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judul = 'Data Siswa';
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
            'nis' => 'required|unique:siswas,nis|unique:users,username',
            'nama' => 'required',
            'jk' => 'required|in:Laki-laki,Perempuan',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
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

        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan.');
    }




    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswas,nis,' . $siswa->id . '|unique:users,username,' . $siswa->user_id,
            'nama' => 'required',
            'jk' => 'required|in:Laki-laki,Perempuan',
        ], [
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
        ]);

        // Update data siswa
        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
        ]);

        // Update akun user agar username tetap sesuai dengan NIS
        $siswa->user->update([
            'name' => $request->nama,
            'username' => $request->nis, // Pastikan username tetap sesuai nis
        ]);

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui.');
    }



    public function destroy(Siswa $siswa, $id)
    {

        $siswa = Siswa::findOrFail($id);

        User::destroy($siswa->user_id);

        $siswa->delete();

        return redirect()->back()->with('success', 'Data Siswa berhasil dihapus.');
    }
}
