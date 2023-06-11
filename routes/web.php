<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSatkerController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\Admin\ChatController;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('opening');
Route::get('/MyHome', [HomeController::class, 'main'])->name('main');

Route::get('/Satker', [SatkerController::class, 'index'])->name('satker');
Route::get('/Satker/{satker:slug}', [SatkerController::class, 'detail_satker'])->name('detail-satker');

Route::get('/Berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/Berita/{berita:slug}', [BeritaController::class, 'show'])->name('baca-berita');

Route::get('/Layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/Test', [BeritaController::class, 'test'])->name('test');

Route::middleware(['auth'])->group(function() {
    Route::post('/Berita/comment/{berita:slug}', [BeritaController::class, 'store_comment'])->name('simpan-komentar');
    Route::delete('/Berita/delete/{comment}', [BeritaController::class, 'delete_comment'])->name('hapus-komentar');
    Route::post('/Berita/like/{comment}', [BeritaController::class, 'comment_like'])->name('like-komentar');
    Route::post('/Berita/dislike/{comment}', [BeritaController::class, 'comment_dislike'])->name('dislike-komentar');

    Route::get('/Profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/Profile/edit', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::get('/Profile/foto', [ProfileController::class, 'photo'])->name('edit-foto');
    Route::patch('/Profile/foto', [ProfileController::class, 'apply_photo'])->name('terapkan-foto');
    Route::patch('/Profile/edit/{user}', [ProfileController::class, 'update'])->name('update-profile');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/Admin/', [AdminController::class, 'index'])->name('admin-main');
    Route::get('/Admin/Accounts', [AdminController::class, 'accounts'])->name('accounts');
    Route::post('/Admin/Accounts', [AdminController::class, 'save_account'])->name('simpan-akun');
    Route::delete('/Admin/Accounts/{user}', [AdminController::class, 'remove_account'])->name('hapus-akun');
    Route::patch('/Admin/Accounts/{user}', [AdminController::class, 'update_account'])->name('update-akun');

    Route::get('/Admin/Satker', [AdminSatkerController::class, 'index'])->name('admin-satker');
    Route::get('/Admin/Satker/{satker:slug}', [AdminSatkerController::class, 'detail'])->name('prev-satker');
    Route::get('/Admin/TambahSatker', [AdminSatkerController::class, 'add'])->name('tambah-satker');
    Route::post('/Admin/TambahSatker', [AdminSatkerController::class, 'save_satker'])->name('simpan-satker');
    Route::get('/Admin/EditSatker/{satker:slug}', [AdminSatkerController::class, 'edit_satker'])->name('edit-satker');
    Route::patch('/Admin/EditSatker/{satker:slug}', [AdminSatkerController::class, 'update_satker'])->name('perbarui-satker');
    Route::delete('/Admin/HapusSatker/{satker:slug}', [AdminSatkerController::class, 'remove_satker'])->name('hapus-satker');

    Route::get('/Admin/Berita', [AdminBeritaController::class, 'index'])->name('admin-berita');
    Route::get('/Admin/TambahBerita', [AdminBeritaController::class, 'add'])->name('tambah-berita');
    Route::get('/Admin/Berita/{berita:slug}', [AdminBeritaController::class, 'preview'])->name('preview-berita');
    Route::post('/Admin/TambahBerita', [AdminBeritaController::class, 'save_news'])->name('simpan-berita');
    Route::post('/Admin/UploadGambarBerita', [AdminBeritaController::class, 'save_news_images'])->name('simpan-gambar-berita');
    Route::get('/Admin/EditBerita/{berita:slug}', [AdminBeritaController::class, 'edit_news'])->name('edit-berita');
    Route::patch('/Admin/EditBerita/{berita:slug}', [AdminBeritaController::class, 'update_news'])->name('update-berita');
    Route::delete('/Admin/HapusBerita/{berita:slug}', [AdminBeritaController::class, 'remove_news'])->name('hapus-berita');

    Route::get('/Admin/Layanan/SIM', [AdminLayananController::class, 'sim'])->name('sim_service');
    Route::get('/Admin/Layanan/STNK', [AdminLayananController::class, 'stnk'])->name('stnk_service');
    Route::get('/Admin/Layanan/SKCK', [AdminLayananController::class, 'skck'])->name('skck_service');
    Route::get('/Admin/Layanan/E-Tilang', [AdminLayananController::class, 'etilang'])->name('etilang_service');


    Route::get('/Admin/Chats', [ChatController::class, 'index'])->name('chats');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
