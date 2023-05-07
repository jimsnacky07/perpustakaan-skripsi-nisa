<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBukuController;
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
});

Route::controller(JenisBukuController::class)->group(function () {
    Route::get('jenis-buku', 'index')->name('jenis-buku');
    Route::post('jenis-buku', 'store')->name('jenis-buku.store');
    Route::get('fetchJenisBuku', 'fetchJenisBuku')->name('jenis-buku.fetch');
    Route::get('jenis-buku/edit', 'edit')->name('jenis-buku.edit');
    Route::post('jenis-buku/edit', 'update')->name('jenis-buku.update');
    Route::post('jenis-buku/destroy', 'destroy')->name('jenis-buku.destroy');
    Route::post('jenis-buku/destroy/selected', 'destroySelected')->name('jenis-buku.destroySelected');
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
