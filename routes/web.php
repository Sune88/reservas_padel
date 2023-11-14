<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaddleCourtController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Booking;
use Carbon\Carbon;
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

Route::get('/test', function(){
    $date = "13-11-2023";
    $paddleCourt = \App\Models\PaddleCourt::find(3);
   // dd(Carbon::parse($date)->format('Y/m/d'));
    $hoursBooked = array();
    $paddleCourtReservtions = Booking::where("paddle_court_id",$paddleCourt->id)
        ->where("date",Carbon::parse($date)->format('Y/m/d'))
        ->get();
    foreach($paddleCourtReservtions as $r){
        $hour_sbooked = explode(":",$r->hour_start)[0];
        $hour_ebooked = explode(":",$r->hour_end)[0];
        foreach(range($hour_sbooked,$hour_ebooked) as $h){
            $hoursBooked[].=$h.":00:00";
        }
    }
    $allHourSchedule = $paddleCourt->resrvation_schedules->pluck('hour_bookable')->toArray();
    $hour_in_free = array_diff($allHourSchedule,$hoursBooked);
    return $hour_in_free;
});

Route::get('/', [HomeController::class,'index'])->name("home");

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
    Route::post('/booking', [PaddleCourtController::class,'booking'])->name("paddleCourt.booking");
    Route::post('/get-free-hour-paddle-court', [PaddleCourtController::class,'showFreeHours'])->name("showFreeHours");

    #Pay
    Route::post('charge',[PaymentController::class,'charge'])->name('charge');
    Route::get('success',[PaymentController::class,'success']);
    Route::get('error', [PaymentController::class,'error']);


    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => 'admin'], function () {
    // Rutas que solo pueden ser accedidas por administradores
    Route::get('/dashboard', function(){
        dd('dentro');
    })->name('admin.dashboard');
    // ... otras rutas administrativas ...
});

require __DIR__.'/auth.php';
