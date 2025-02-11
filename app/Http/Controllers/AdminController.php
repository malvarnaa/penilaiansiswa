<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\UploadAdmin;
use App\Models\UploadGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminDashboard() {
        $title = 'Selamat Datang, ';
        $totalGuru = Guru::count();
        $totalMapel = Mapel::count();
        $totalKelas = Kelas::count();
        $user = Auth::user();

        $pengguna = Auth::user();  // Mengambil data guru terkait dengan user yang login

        return view('page.dashboard', compact('title', 'user', 'totalGuru', 'totalMapel', 'totalKelas', 'pengguna'));
    }
    
    public function guruDashboard() {
        $title = 'Selamat Datang, ';
        $totalGuru = Guru::count();
        $totalMapel = Mapel::count();
        $totalKelas = Kelas::count();
        $guru = Guru::with('mapel')->where('user_id', auth()->user()->id)->first(); 

        $pengguna = Auth::user();  // Mengambil data guru terkait dengan user yang login

        return view('page.dashboard', compact('title', 'guru', 'totalMapel', 'totalGuru', 'totalKelas', 'pengguna'));
    }
    

    public function siswaDashboard() {
        $title = 'Selamat Datang, ';

        $pengguna = Auth::user();  // Mengambil data guru terkait dengan user yang login

        return view('page.dashboard', compact('title', 'pengguna'));
    }

    public function landing() {
        return view('page.landing');
    }

    public function lamanUpload() {
        $judul = "Blanko Dokumen";
        $uploads = UploadAdmin::all();
        return view('admin.upload', compact('judul', 'uploads'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240', // max size 10MB
        ]);
        
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file
        $filePath = $file->storeAs('pdfs', $fileName, 'public');
        
        UploadAdmin::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'user_id' => auth()->id(), // Admin yang meng-upload
        ]);
        
        return redirect()->route('admin.upload')->with('success', 'PDF berhasil di-upload');        
    }

    public function listUnduh() {
        $judul = "File yang telah diunduh.";
        $file = UploadAdmin::all();

        return view('tp.fileUnduh', compact('judul', 'file'));
    }

    public function show($id) {
        $file = UploadAdmin::findOrFail($id);

        // Path file di storage
        $filePath = storage_path('app/public/' . $file->file_path);

        // Return response untuk membuka PDF di browser
        return response()->file($filePath);
    }

    public function deleteFile($id)
    {
        // Cari file berdasarkan ID
        $upload = UploadAdmin::findOrFail($id);
    
        // Hapus file dari penyimpanan
        if (Storage::disk('public')->exists($upload->file_path)) {
            Storage::disk('public')->delete($upload->file_path);
        }
    
        // Hapus data dari database
        $upload->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.upload')->with('success', 'File berhasil dihapus.');
    }

    public function reviewTP()
    {
        $judul = 'Riwayat Upload Tujuan Pembelajaran';
        $uploads = UploadGuru::all(); // Bisa difilter lebih lanjut untuk status tertentu
    
        return view('admin.reviewtp', compact('uploads', 'judul'));
    }
    
    public function dataMaster() {
        
        return view('admin.datamaster');
    }


}
