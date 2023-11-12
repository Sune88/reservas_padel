@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12 col-md-12" style="text-align: center">
                    <div class="card">
                        <div class="card-header">
                            <h4>Confirmacion de la reserva</h4>
                        </div>

                        <div class="card-body">
                            <p>Pista: {{$paddle_court->name}}</p>
                            <p>Rango horas: {{$hour_start_raw . ' - '. $hour_end_raw}}</p>
                            <p>Total horas: {{$total_hours}}</p>
                            <p>Precio por hora: {{number_format($paddle_court->price),2}}€</p>
                            <p>Precio total: {{number_format($booking->total_amount,2)}}€</p>
                        </div>
                        <div class="card-footer">
                            <form action="{{route('charge')}}" method="post">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                <button type="submit" class="btn btn-primary">
                                    Pagar ({{number_format($booking->total_amount,2)}}€)
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
