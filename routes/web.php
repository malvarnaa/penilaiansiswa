<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CpController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('page.landing');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->name('page.login');
Route::post('/login', [LoginCOntroller::class, 'login'])->name('page.login');

Route::get('/landing-page', [AdminController::class, 'landing'])->name('page.landing');



Route::middleware(['guest'])->group(function () {

});


Route::middleware(['auth', 'userAkses:admin'])->group(function () {
    Route::get('/data/guru', [GuruController::class, 'index'])->name('guru.dataguru');
    Route::post('/data/guru/store', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/data/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::get('/data/guru/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::get('/data/guru/show/{id}', [GuruController::class, 'show'])->name('guru.show');
    Route::put('/data/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/data/guru/destroy{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
    Route::post('/upload/tp', [GuruController::class, 'uploadTP'])->name('guru.uploadtp');
    Route::get('/get-mapel-by-kelas', [GuruController::class, 'getMapelByKelas'])->name('getmapel.bykelas');

    Route::get('/data-master', [AdminController::class, 'dataMaster'])->name('admin.dataMaster');

    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('student.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('student.store');
    Route::get('/siswa/edit', [SiswaController::class, 'edit'])->name('student.edit');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('student.update');
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('student.destroy');

    Route::post('/jurusan-mapel/store', [MapelController::class, 'jurusanStore'])->name('jurusan.store');
    Route::get('/mata-pelajaran/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/mata-pelajaran/store', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/{mapel}/guru', [MapelController::class, 'showGuru'])->name('mapel.showGuru');

    Route::get('/konsentrasi-keahlian', [MapelController::class, 'jurusanIndex'])->name('jurusan.index');
    Route::get('/jurusan-tambah', [MapelController::class, 'jurusanCreate'])->name('jurusan.create');
    Route::get('/jurusan-edit', [MapelController::class, 'jurusanEdit'])->name('jurusan.edit');
    Route::put('/jurusan-update/{id}', [MapelController::class, 'jurusanUpdate'])->name('jurusan.update');
    Route::delete('/jurusan-destroy/{id}', [MapelController::class, 'jurusanDestroy'])->name('jurusan.destroy');

    Route::get('/data/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::get('/kelas/all', [KelasController::class, 'indexAll'])->name('kelas.all');
    Route::post('/kelas/{kelas}', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/get-kelas-mapel/{jurusan_id}', [GuruController::class, 'getKelasMapel']);
    

    Route::get('/dashboard/admin', [AdminController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::get('/upload/template', [AdminController::class, 'lamanUpload'])->name('admin.upload');
    Route::post('/upload/template/store', [AdminController::class, 'upload'])->name('admin.store');
    Route::delete('/upload/template/del/{id}', [AdminController::class, 'deleteFile'])->name('admin.delete');

    Route::get('/admin/review-tp', [AdminController::class, 'reviewTP'])->name('tp.review');

});

Route::middleware(['auth', 'userAkses:admin,guru'])->group(function () {
    Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('mapel.index');

    Route::get('/data/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/{kelas}', [KelasController::class, 'showKelas'])->name('kelas.show');

    Route::get('/tujuan/pembelajaran', [TpController::class, 'index'])->name('tp.index');
    Route::post('/tujuan/pembelajaran/store', [TpController::class, 'store'])->name('tp.store');
    Route::get('/download-tp', [TpController::class, 'hasilunduhan'])->name('tp.hasilunduhan');
    Route::get('/tujuan/pembelajaran/download', [TpController::class, 'downloadBlanko'])->name('download.blanko');

    Route::get('/list/file', [AdminController::class, 'listUnduh'])->name('admin.listUnduh');


    Route::delete('/review/destroy/{id}', [GuruController::class, 'destroyTP'])->name('review.destroy');


    Route::get('/upload/template/show/{id}', [AdminController::class, 'show'])->name('admin.show');

    Route::get('/data/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/kelas/{kelas}/siswa', [KelasController::class, 'showSiswa'])->name('kelas.siswa');

    Route::get('/capaian-pembelajaran/{mapel_id}', [CpController::class, 'index'])->name('cp.index');
    Route::post('/capaian-pembelajaran/store', [CpController::class, 'store'])->name('cp.store');

    Route::post('tujuan-pembelajaran/{cp}', [TpController::class, 'store'])->name('tp.store');


});

Route::middleware(['auth', 'userAkses:guru'])->group(function () {
    Route::get('/dashboard/guru', [AdminController::class, 'guruDashboard'])->name('dashboard.guru');

    Route::get('/tp/hasilunduhan', [GuruController::class, 'hasilUnduhan'])->name('tp.hasilunduhan');
    Route::post('/tp/upload', [GuruController::class, 'uploadTP'])->name('guru.uploadtp');
});


Route::middleware(['auth', 'userAkses:siswa'])->group(function ()  {
    Route::get('/dashboard/siswa', [AdminController::class, 'siswaDashboard'])->name('dashboard.siswa');
});