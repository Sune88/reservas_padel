<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingState;
use App\Models\PaddleCourt;
use App\Models\ReservationSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaddleCourtController extends Controller
{

    public function index()
    {
        $paddleCourt = PaddleCourt::all();
        return view('paddleCourt.index', compact('paddleCourt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function showFreeHours(Request $request)
    {

        $paddleCourt = \App\Models\PaddleCourt::find($request->paddle_court_id);

        // dd(Carbon::parse($date)->format('Y/m/d'));
        $hoursBooked = array();
        $paddleCourtReservtions = Booking::where("paddle_court_id", $paddleCourt->id)
            ->where("date", Carbon::parse($request->date)->format('Y/m/d'))
            ->get();
        foreach ($paddleCourtReservtions as $r) {
            $hour_sbooked = explode(":", $r->hour_start)[0];
            $hour_ebooked = explode(":", $r->hour_end)[0] - 1;
            foreach (range($hour_sbooked, $hour_ebooked) as $h) {
                $hoursBooked[] .= $h . ":00:00";
            }
        }
        $allHourSchedule = $paddleCourt->resrvation_schedules->pluck('hour_bookable')->toArray();
        $hour_in_free = array_diff($allHourSchedule, $hoursBooked);
        return response()->json(["free_hours" => $hour_in_free, "count" => count($hour_in_free)]);
    }

    public function show($paddleCourt_id)
    {

        $paddleCourt = PaddleCourt::find($paddleCourt_id);

        return view('paddleCourt.show', compact('paddleCourt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaddleCourt $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaddleCourt $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaddleCourt $product)
    {
        //
    }

    public function booking(Request $request)
    {

        $request->validate([
            "paddle_court_id" => "required|exists:paddle_courts,id",
            "date" => "required|date|after:today",
            "hour_start" => "required|exists:reservation_schedules,id",
            "hour_end" => "required|exists:reservation_schedules,id",
        ], [
            "paddle_court_id" => "Pista",
            "date.required" => "Fecha es obligatoria",
            "hour_start.required" => "Hora de entrada es obligatoria",
            "hour_end.required" => "Hora de salida es obligatoria",
        ], ["required" => "requerido"]);
        $paddle_court = PaddleCourt::find($request->paddle_court_id);
        $diaDeLaSemana = date('w', strtotime($request->date));
        if ($diaDeLaSemana == 0 || $diaDeLaSemana == 6) {
            return redirect()->back()->with("error", "No se puden hacer reservas para fines de semana.");
        }
        $hour_start_raw = ReservationSchedule::find($request->hour_start)->hour_bookable;
        $hour_end_raw = ReservationSchedule::find($request->hour_end)->hour_bookable;
        $booking_exist = Booking::where("user_id", Auth::id())
            ->where('date', $request->date)
            ->where('hour_start', $hour_start_raw)
            ->where('hour_end', $hour_end_raw)
            ->where('paddle_court_id', $paddle_court->id)
            ->first();
        if ($booking_exist) {
            $booking_exist->delete();
        }
        $paddleCourtBooked = Booking::where("paddle_court_id", $request->paddle_court_id)
            ->where("date", $request->date)
            ->get();
        $hour_s = explode(":", $hour_start_raw)[0];
        $hour_e = explode(":", $hour_end_raw)[0] - 1;
        $horas_coincidentes = array();
       // dump("Hora solicitud reserva: " . $hour_s . " - " . $hour_e);
        foreach ($paddleCourtBooked as $pdBooked) {
            $hour_sbooked = explode(":", $pdBooked->hour_start)[0];
            $hour_ebooked = explode(":", $pdBooked->hour_end)[0];
            foreach (range($hour_s, $hour_e) as $h) {
                if ($h >= $hour_sbooked && $h < $hour_ebooked) {
                    $horas_coincidentes[] .= $h . ":00";
                }
            }
        }

        $total_hours = ($hour_e + 1) - $hour_s;
        $total_price = $total_hours * $paddle_court->price;
        //dump($total_hours,$total_price);
        sort($horas_coincidentes);
        // dd($horas_coincidentes);
        $confirm_success = count($horas_coincidentes) == 0;
        $state = BookingState::where('name', 'Pendiente')->first();
        //Crear booking
        $booking = null;
        if ($confirm_success) {

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'date' => $request->date,
                'hour_start' => $hour_start_raw,
                'hour_end' => $hour_end_raw,
                'paddle_court_id' => $paddle_court->id,
                'total_amount' => $total_price,
                'booking_state_id' => $state->id,
                'paid' => 0
            ]);
            $hour_start_raw = explode(":",$hour_start_raw)[0].":".explode(":",$hour_start_raw)[1];
            $hour_end_raw = explode(":",$hour_end_raw)[0].":".explode(":",$hour_start_raw)[1];
            return view('bookings.confirm_booking', compact('booking',
                'paddle_court', 'hour_start_raw', 'hour_end_raw', 'total_hours', 'total_price'));

        }else{
            return redirect()->back()->with("error", "Hay algunas horas que has elegido que ya están reservadas, elige otras.");
        }

    }
}
