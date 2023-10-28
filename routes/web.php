<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaddleCourtController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class,'index'])->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

## Psitas

Route::get('/pistas', [PaddleCourtController::class,'index'])->name("paddleCourt.index");
Route::get('/pista/{id}', [PaddleCourtController::class,'show'])->name("paddleCourt.show");



Route::middleware('auth')->group(function () {

    /*#Carrito
    Route::get('/cart', [CartController::class, 'index'])->name('index.cart');
    Route::post('/add-cart', [CartController::class, 'store'])->name('add.cart');
    Route::post('/update-cart', [CartController::class, 'update'])->name('reload.cart');
    Route::post('/delete-cart', [CartController::class, 'destroy'])->name('destroy.item.cart');

    #Pedidos
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');*/
});

require __DIR__.'/auth.php';
