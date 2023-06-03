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

Route::get('/', [HomeController::class, 'index'])->name('main');

Route::get('/Satker', [SatkerController::class, 'index'])->name('satker');
Route::get('/Satker/{satker:slug}', [SatkerController::class, 'detail_satker'])->name('detail-satker');

Route::get('/Berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/Berita/{berita:slug}', [BeritaController::class, 'show'])->name('baca-berita');

Route::get('/Layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/Profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');

Route::get('/Admin/', [AdminController::class, 'index'])->name('admin-main');
Route::get('/Admin/Accounts', [AdminController::class, 'accounts'])->name('accounts');
Route::get('/Admin/Reports', [AdminController::class, 'reports'])->name('reports');

Route::get('/Admin/Satker', [AdminSatkerController::class, 'index'])->name('admin-satker');
Route::get('/Admin/Satker/add', [AdminSatkerController::class, 'add'])->name('tambah-satker');
Route::post('/Admin/Satker/add', [AdminSatkerController::class, 'save_satker'])->name('simpan-satker');
Route::get('/Admin/Satker/edit/{satker:slug}', [AdminSatkerController::class, 'edit_satker'])->name('edit-satker');
Route::patch('/Admin/Satker/edit/{satker:slug}', [AdminSatkerController::class, 'update_satker'])->name('perbarui-satker');
Route::delete('/Admin/Satker/delete/{satker:slug}', [AdminSatkerController::class, 'remove_satker'])->name('hapus-satker');

Route::get('/Admin/Berita', [AdminBeritaController::class, 'index'])->name('admin-berita');
Route::get('/Admin/Berita/new', [AdminBeritaController::class, 'add'])->name('tambah-berita');
Route::post('/Admin/Berita/save', [AdminBeritaController::class, 'save_news'])->name('simpan-berita');
Route::delete('/Admin/Berita/delete/{berita:slug}', [AdminBeritaController::class, 'remove_news'])->name('hapus-berita');

Route::get('/Admin/Layanan/SIM', [AdminLayananController::class, 'sim'])->name('sim_service');
Route::get('/Admin/Layanan/STNK', [AdminLayananController::class, 'stnk'])->name('stnk_service');
Route::get('/Admin/Layanan/SKCK', [AdminLayananController::class, 'skck'])->name('skck_service');
Route::get('/Admin/Layanan/E-Tilang', [AdminLayananController::class, 'etilang'])->name('etilang_service');


Route::get('/Admin/Chats', [ChatController::class, 'index'])->name('chats');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
