<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;



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


Route::resource('pakets', PaketController::class);
Route::resource('customers', CustomerController::class);
Route::resource('pemesanans', PemesananController::class);
Route::resource('pembayarans', PembayaranController::class);

Route::get('/getPemesananData/{id}', [PembayaranController::class, 'getPemesananData']);

// Auth::routes(); 
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Login Register Logout 
Route::get('/login', [AuthenticationController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthenticationController::class, 'showFormRegister'])->name('register');
Route::post('/register-post', [AuthenticationController::class, 'postRegister'])->name('register.post');
Route::get('/logout', [AuthenticationController::class, 'Logout'])->name('logout');

// Laporan route
Route::get('/export-excel', [LaporanController::class, 'exportExcel'])->name('export.excel');
//Route::get('/cetak-laporan', [LaporanController::class, 'exportExcel'])->name('export.excel');
Route::get('/laporan', [LaporanController::class, 'cetakLaporanExcel'])->name('cetak.laporan');

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD paket, customer, pemesanan, dan pembayaran untuk admin
    Route::resource('pakets', PaketController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('pemesanans', PemesananController::class);
    Route::resource('pembayarans', PembayaranController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// Rute untuk user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('customers', CustomerController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('pemesanans', PemesananController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);    
    Route::resource('pembayarans', PembayaranController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('pakets', [PaketController::class, 'index']); // User hanya bisa melihat paket
});

Route::get('/unauthorized', function () {
    return view('unauthorized'); // Pastikan view ini ada
});

Route::get('/pakets', [PaketController::class, 'index'])->name('pakets.index');


