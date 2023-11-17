<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaddleCourtRateRequest;
use App\Models\Booking;
use App\Models\BookingState;
use App\Models\PaddleCourt;
use App\Models\ReservationSchedule;
use App\Models\ValorationsCourt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
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
    public function cancel($bookingId){
        $booking = Booking::find($bookingId);
        if($booking->paid == 1){
            return redirect()->back()->with('warning', 'Esta reserva no se puede cancelar.');;
        }
        if($booking->user_id != Auth::id()){
            return redirect()->back()->with('error', 'No puedes cancelar esta reserva.');;
        }
        $bookingState = BookingState::where('name',"Cancelado")->first();
        $booking->booking_state_id = $bookingState->id;
        $booking->save();
        return redirect()->route('profile.edit')->with('status', 'Reserva cancelada correctamente.');;

    }
    public function destroy($id){
        Booking::destroy($id);
        return redirect()->back()->with('status','Reserva eliminada correctamente.');
    }

}
