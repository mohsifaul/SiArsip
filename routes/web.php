<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriSuratController;
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

Route::get('/laravel', function () {
    return view('welcome');
});
// Route::get('/', function () {
//     return view('login  ');
// });
// Route::get('/dashboard', function () {
//     return view('/dashboard');
// });
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/masuk', [LoginController::class, 'login'])->name('masuk');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/arsip-surat', [SuratController::class, 'index'])->name('arsip-surat');
    Route::get('/tambah-arsip', [SuratController::class, 'formTambah']);
    Route::post('/simpan-arsip', [SuratController::class, 'store'])->name('simpan-arsip');
    Route::get('/edit-arsip/{id}', [SuratController::class, 'edit'])->name('edit-arsip');
    Route::post('/update-arsip/{id}', [SuratController::class, 'update'])->name('update-arsip');
    Route::get('/unduh-surat/{id}', [SuratController::class, 'unduhFileSurat'])->name('unduh-surat');
    Route::get('/lihat-surat/{kd_surat}', [SuratController::class, 'show'])->name('lihat-surat');
    Route::post('/hapus-surat/{id}', [SuratController::class, 'destroy'])->name('hapus-surat');

    Route::get('/kategori-surat', [KategoriSuratController::class, 'index']);
    Route::get('/tambah-kategori-surat', [KategoriSuratController::class, 'formTambah']);
    Route::post('/simpan-kategori', [KategoriSuratController::class, 'store'])->name('simpan-kategori');
    Route::get('/edit-kategori/{id}', [KategoriSuratController::class, 'edit'])->name('edit-kategori');
    Route::post('/update-kategori/{id}', [KategoriSuratController::class, 'update'])->name('update-kategori');
    Route::post('/hapus-kategori/{id}', [KategoriSuratController::class, 'destroy'])->name('hapus-kategori');

    Route::get('/profil', function () {
        return view('/profil');
    });
});