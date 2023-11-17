<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaddleCourtStoreRequest;
use App\Models\Booking;
use App\Models\BookingState;
use App\Models\PaddleCourt;
use App\Models\ReservationSchedule;
use App\Models\User;
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
     * Store a newly created resource in storage.
     */
    public function store(PaddleCourtStoreRequest $request)
    {
        $nombreArchivo = Auth::id() . time() . $request->file('image')->extension();
        $rutaImage = $request->file('image')->storeAs('images_paddle_courts', $nombreArchivo, 'public');
        $paddleCourt = PaddleCourt::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $rutaImage,
            'price' => $request->price,
        ]);
        foreach (range(9, 21) as $hour) {
            ReservationSchedule::create([
                "paddle_court_id" => $paddleCourt->id,
                "hour_bookable" => $hour . ":00",
            ]);
        }
        return redirect()->back()->with('status', 'Pista creada correctamente.');

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
    public function edit($id)
    {
        $paddlecourt = PaddleCourt::find($id);
        return view('paddleCourt.edit', compact('paddlecourt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $paddleCourt = PaddleCourt::find($request->id);
        if ($request->image) {
            $nombreArchivo = Auth::id() . time() . $request->file('image')->extension();
            $rutaImage = $request->file('image')->storeAs('images_paddle_courts', $nombreArchivo, 'public');
            $paddleCourt->image = $rutaImage;
        }
        $paddleCourt->name = $request->name;
        $paddleCourt->description = $request->description;
        $paddleCourt->price = $request->price;
        $paddleCourt->save();
        return redirect()->route('admin.dashboard')->with('status', 'Pista actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PaddleCourt::destroy($id);
        return redirect()->back()->with('status', 'Pista eliminada correctamente.');
    }

}
