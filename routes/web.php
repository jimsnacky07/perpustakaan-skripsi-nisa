<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBukuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RakBukuController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('buku', BookController::class);
    Route::resource('anggota', AnggotaController::class);

    //Jenis Buku
    Route::controller(JenisBukuController::class)->group(function () {
        Route::get('jenis-buku', 'index')->name('jenis-buku');
        Route::post('jenis-buku', 'store')->name('jenis-buku.store');
        Route::get('fetchJenisBuku', 'fetchJenisBuku')->name('jenis-buku.fetch');
        Route::get('jenis-buku/edit', 'edit')->name('jenis-buku.edit');
        Route::post('jenis-buku/edit', 'update')->name('jenis-buku.update');
        Route::post('jenis-buku/destroy', 'destroy')->name('jenis-buku.destroy');
        Route::post('jenis-buku/destroy/selected', 'destroySelected')->name('jenis-buku.destroySelected');
    });

    //User
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index')->name('user');
        Route::post('user', 'store')->name('user.store');
        Route::get('fetchUser', 'fetchUser')->name('user.fetch');
        Route::get('user/edit', 'edit')->name('user.edit');
        Route::post('user/edit', 'update')->name('user.update');
        Route::post('user/destroy', 'destroy')->name('user.destroy');
        Route::post('user/destroy/selected', 'destroySelected')->name('user.destroySelected');
    });

    //Rak Buku
    Route::controller(RakBukuController::class)->group(function () {
        Route::get('rak-buku', 'index')->name('rak-buku');
        Route::post('rak-buku', 'store')->name('rak-buku.store');
        Route::get('fetchRakBuku', 'fetchRakBuku')->name('rak-buku.fetch');
        Route::get('rak-buku/edit', 'edit')->name('rak-buku.edit');
        Route::post('rak-buku/edit', 'update')->name('rak-buku.update');
        Route::post('rak-buku/destroy', 'destroy')->name('rak-buku.destroy');
        Route::post('rak-buku/destroy/selected', 'destroySelected')->name('rak-buku.destroySelected');
    });

    //Peminjmaan
    Route::controller(PeminjamanController::class)->group(function () {
        Route::get('/peminjaman', 'index')->name('peminjaman');
        Route::get('/tambah-peminjaman', 'create')->name('peminjaman.create');
        Route::post('/simpan-peminjaman',  'store')->name('peminjaman.store');
        Route::get('/cetak-bukti-peminjaman/{id}',  'cetakBuktiPeminjaman')->name('cetak-bukti-peminjaman');
        Route::delete('/hapus-peminjaman/{id}',  'destroy')->name('peminjaman.destroy');
        Route::get('/detail-peminjaman/{id}',  'detail')->name('detail-peminjaman');

        //Temporary

        Route::post('/simpan-temp', [PeminjamanController::class, 'storeTemp'])->name('simpan-temp');
        Route::get('/panggil-temp', [PeminjamanController::class, 'showTemp'])->name('panggil-temp');
        Route::post('/hapus-temp-all', [PeminjamanController::class, 'deleteAllTemp'])->name('hapus-temp-all');
        Route::get('/delete-temp-item/{id}', [PeminjamanController::class, 'deleteItemTemp'])->name('hapus-temp-item');
    });

    //pengembalian 
    Route::controller(PengembalianController::class)->group(function () {
        Route::get('/pengembalian', 'index')->name('pengembalian');
        Route::get('/tambah-pengembalian', 'tambah')->name('pengembalian.create');
        Route::post('/simpan-pengembalian', 'store')->name('pengembalian.store');
        Route::post('/getkampung', 'getkampung')->name('getkampungzonasi');
    });

    Route::controller(LaporanController::class)->name('laporan.')->group(function () {
        Route::get('/laporan-kategori-buku', 'kategoriBuku')->name('kategori-buku');
        Route::get('/laporan-anggota', 'anggota')->name('anggota');
        Route::get('/laporan-buku', 'buku')->name('buku');
        Route::get('/laporan-rak', 'rakBuku')->name('rak-buku');
        Route::get('/laporan-riwayat-peminjaman', 'riwayatPeminjaman')->name('riwayat-peminjaman');
    });
});



Auth::routes();

Route::prefix('anggota')->middleware(['auth', 'user-role:anggota'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::prefix('pimpinan')->middleware(['auth', 'user-role:pimpinan'])->group(function () {
    Route::get('/home', [HomeController::class, 'pimpinan'])->name('pimpinan');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
