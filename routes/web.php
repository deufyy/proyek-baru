<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Awal buka web langsung diarahkan ke Login
Route::get('/', function () {
    return redirect('/login');
});

// ROUTE BEBAS AKSES (TANPA LOGIN)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ROUTE DIKUNCI (HARUS LOGIN TERLEBIH DAHULU)
Route::middleware([CheckLogin::class])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');

    // Route Inventory / Produk
    Route::get('/inventory', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Route Transaksi & Laporan Rental
    Route::get('/reports', [TransactionController::class, 'index'])->name('reports.index');
    Route::get('/create-transaction', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{id}/status', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

});