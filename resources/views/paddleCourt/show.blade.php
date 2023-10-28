@extends('layouts.app')

@section("content")
    <style>
        .caret {
            position: relative;
            top: 15px;
            left: -25px;
        }
    </style>
    <section id="menu-information" class="container information generic">
        <div class="card p-6 mb-6">
            <div class="row">

                <div class="col-12 col-md-6" style="text-align: center">
                    <img style="height: auto;border-radius: 5px" src="{{$paddleCourt->image}}">
                </div>
                <div class="col-12 col-md-6">
                    <h1>{{$paddleCourt->name}}</h1>
                    <span>{{$paddleCourt->description}}</span>
                    <div class="row">
                        <div class="col-6">
                            <p class="ml-4" style="font-size: 24px;font-weight: bold">Precio: {{$paddleCourt->price}}
                                h/€</p>
                        </div>
                        <div class="col-12">
                            <form class="form-group" action="" method="post">
                                <div class="row" style="margin-right: unset;margin-left: unset">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Fecha:</label>
                                            <input class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                                   min="{{\Carbon\Carbon::now()->modify('+1 day')->format('Y-m-d')}}"
                                                   id="date_input" type="date" name="date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>Hora de inicio:</label>
                                        <div class="input-group" style="display: flex">

                                            <select class="form-control" id="hour_start_input" name="hour_start">
                                                <option selected
                                                    value="">Selecciona una hora de inicio
                                                </option>
                                                @foreach($paddleCourt->resrvation_schedules as $reservationSchedule)
                                                    <option
                                                        value="{{$reservationSchedule->id}}">{{\Carbon\Carbon::parse($reservationSchedule->hour_bookable)->format("H:i")}}</option>
                                                @endforeach
                                            </select>
                                            <span class="caret"></span>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label>Hora de fin:</label>
                                        <div class="input-group" style="display: flex">
                                            <select class="form-control" id="hour_end_input" name="hour_end">
                                                <option
                                                    value="">--
                                                </option>

                                            </select>
                                            <span class="caret"></span>

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <a id="btn_add_cart" data-product_id="{{$paddleCourt->id}}"
                                           class="btn btn-primary">Hacer
                                            reserva </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@section("javascript")
    <script>
        var array_hours = @json($paddleCourt->resrvation_schedules);
        var last_id = array_hours[array_hours.length - 1].id
        console.log(array_hours)
        document.getElementById('hour_start_input').addEventListener('input', function () {
            if(this.value==""){
                return;
            }
            var value_selected = parseInt(this.value)+1;
            var input_hour_end = document.getElementById('hour_end_input')
            input_hour_end.innerHTML = ''
            var newOptions =  array_hours.filter(function(hora) {
                return hora.id >= value_selected;
            });
            for (var i = 0; i < newOptions.length; i++) {
                var option = document.createElement('option');
                option.value = newOptions[i].id; // Asigna un valor a la opción (puede ser cualquier valor)
                option.text = (newOptions[i].hour_bookable).split(':')[0]+':'+(newOptions[i].hour_bookable).split(':')[1]; // Asigna el texto de la opción
                input_hour_end.add(option);
            }
        });
    </script>
    <script>
        document.getElementById('date_input').addEventListener('input', function () {
            var fechaSeleccionada = new Date(this.value);
            var diaSemana = fechaSeleccionada.getDay();

            // Puedes deshabilitar los días que quieras aquí
            if (diaSemana === 0 || diaSemana === 6) {
                alert('Los fines de semana están deshabilitados.');
                this.value = '';
            }
        });

    </script>

@endsection
