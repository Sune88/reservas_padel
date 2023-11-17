<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaddleCourtController;
use App\Http\Controllers\PaddleCourtRateController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/test', function(){
    $images = [
        "https://www.padeladdict.com/wp-content/uploads/2023/06/la-guia-definitiva-para-mantener-pistas-de-padel-cubiertas-portada-1068x580.jpg",
        "https://ucjcsportsclub.es/wp-content/uploads/2015/03/padel3-1024x780.jpg",
        "https://allforpadel.com/img/cms/pistas/fx2-1.jpg",
    ];
    Storage::delete("public/images_paddle_courts");
    $images_storage = array();
    foreach($images as $image){
        $imageData = file_get_contents($image);

        $nombreArchivo = 'imagen_' . uniqid() . '.jpg';;
        Storage::put("public/images_paddle_courts/{$nombreArchivo}", $imageData);

        array_push($images_storage,"images_paddle_courts/{$nombreArchivo}");
    }
    dd($images_storage);
});

Route::get('/', [HomeController::class,'index'])->name("home");
Route::get('/reglas', [HomeController::class,'rules'])->name("rules");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

## Pistas

Route::get('/pistas', [PaddleCourtController::class,'index'])->name("paddleCourt.index");
Route::get('/pista/{id}', [PaddleCourtController::class,'show'])->name("paddleCourt.show");

## Contacto
Route::get('/contacto', [ContactController::class,'index'])->name("contact.index");
Route::post('/contacto', [ContactController::class,'send'])->name("contact.send");



Route::middleware('auth')->group(function () {
    Route::post('/booking', [BookingController::class,'store'])->name("paddleCourt.booking");
    Route::get('/booking-cancel/{booking_id}', [BookingController::class,'cancel'])->name("cancel.booking");
    Route::post('/paddlecourt-rate', [PaddleCourtRateController::class,'store'])->name("rate.paddlecourt");
    Route::post('/get-free-hour-paddle-court', [PaddleCourtController::class,'showFreeHours'])->name("showFreeHours");

    #Pay
    Route::post('charge',[PaymentController::class,'charge'])->name('charge');
    Route::get('success',[PaymentController::class,'success']);
    Route::get('error', [PaymentController::class,'error']);

    #Perfil
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => 'admin'], function () {
    // Rutas que solo pueden ser accedidas por administradores
    Route::get('/dashboard',[HomeController::class,'admin'] )->name('admin.dashboard');
    Route::get('/contact-destroy/{contact_id}',[ContactController::class,'destroy'] )->name('contact.destroy');
    Route::get('/booking-destroy/{booking_id}',[BookingController::class,'destroy'] )->name('booking.destroy');

    //users
    Route::post('/user-create',[UserController::class,'store'] )->name('user.store');
    Route::get('/user-destroy/{user_id}',[UserController::class,'destroy'] )->name('user.destroy');

    //paddle courts
    Route::post('/paddle-court-create',[PaddleCourtController::class,'store'] )->name('paddlecourt.store');
    Route::get('/paddle-court-destroy/{paddle_court_id}',[PaddleCourtController::class,'destroy'] )->name('paddlecourt.destroy');
    Route::get('/paddle-court-edit/{paddle_court_id}',[PaddleCourtController::class,'edit'] )->name('paddlecourt.edit');
    Route::post('/paddle-court-update',[PaddleCourtController::class,'update'] )->name('paddlecourt.update');


});

require __DIR__.'/auth.php';
