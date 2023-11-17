@extends('layouts.app')

@section("content")
    <section id="menu-information" class="container information">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12 col-md-12" style="text-align: center">
                    <h1 id="fittext2" class="title-start">Nuestras pistas</h1>
                </div>
                <div class="col-12 mt-6">
                    <div class="row">
                        @foreach($paddleCourt as $pc)
                            <div class="col-12 col-md-4 mb-4 mt-6">
                                <div class="card">
                                    <div class="card-head">
                                        <img style="object-fit: cover; width:100%; height: 230px" src="{{asset('storage/' . $pc->image)}}">
                                    </div>
                                    <div class="card-body">
                                        <p>{{$pc->name}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <p style="font-size: 24px;font-weight: bold">Precio: {{$pc->price}}€</p>
                                            </div>
                                            <div class="col-6 col-md-6"style="text-align: end" >
                                                <a href="{{route('paddleCourt.show',$pc->id)}}" class="info">Ver más</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
