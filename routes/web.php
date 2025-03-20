<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientProdukController;
use App\Http\Controllers\ClientBookingController;
use App\Http\Controllers\ClientPesananController;

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
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticating']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'registerProcess']);

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    Route::middleware('role:admin,seller')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::resource('/produk', ProdukController::class);
        Route::resource('/kategori', KategoriController::class);

        Route::get('/reservasi', [BookingController::class, 'index'])->name('reservasi.index');
        Route::post('/reservasi/update-payment', [BookingController::class, 'updateTypePayment'])->name('reservasi.updateTypePayment');
        Route::post('/reservasi/{id}/approve', [BookingController::class, 'approve'])->name('reservasi.approve');
        Route::post('/reservasi/{id}/cancel', [BookingController::class, 'cancel'])->name('reservasi.cancel');
        
        Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
        Route::get('/mutasi/pdf', [MutasiController::class, 'exportPdf'])->name('mutasi.pdf');
        
        Route::get('/customer', [UserController::class, 'customerIndex'])->name('customer.index');
        Route::get('/seller', [UserController::class, 'sellerIndex'])->name('seller.index');
    });

    Route::middleware('role:client')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about', [AboutController::class, 'index']);
        Route::get('/pesanan', [ClientPesananController::class, 'index'])->name('pesanan.index');
        Route::delete('/pesanan/{id}', [ClientPesananController::class, 'destroy'])->name('pesanan.destroy');

        Route::get('/detail/{id}', [ClientProdukController::class, 'show'])->name('produk.detail');
        Route::post('/detail', [ClientProdukController::class, 'store'])->name('detail.store');

        Route::get('/booking', [ClientBookingController::class, 'index'])->name('booking.index');
        Route::get('/booking/{id}/payment', [ClientBookingController::class, 'showPaymentForm'])->name('booking.payment');
        Route::post('/booking/{id}/payment', [ClientBookingController::class, 'storePayment'])->name('booking.payment.store');
    });
});

Route::get('/about', [AboutController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [ClientProdukController::class, 'show'])->name('produk.detail');
Route::get('/pesanan', [ClientPesananController::class, 'index'])->name('pesanan.index');
