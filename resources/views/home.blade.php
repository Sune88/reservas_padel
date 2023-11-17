@extends('layouts.app')

@section("content")
    <div class="homepage">
        <!-- Slider and Form -->
        <section id="menu-slider" class="header">
            <div class="container">
                <div class="col-md-12 col-xs-12 col-sm-12 content_slider">
                    <h1 id="fittext3" class="title-head text-center white">
                        Padel Sport
                    </h1>

                    <p class="sub-title-head text-center white">
                        ¡Conquista la Pista, Eleva tu Juego! Descubre la Experiencia Total en nuestro club.
                    </p>
                    <div class="top-info text-center">
                        <a href="{{route('rules')}}" class="info">Normas del pádel</a>
                    </div>
                </div>
                <!-- /slider -->
            </div>
        </section>
        <!-- end Slider and Form -->
    </div>

    <!-- Features -->
    <section id="menu-features" class="features">
        <h2 id="fittext2" class="title-start">Sobre nosotros</h2>
        <p class="sub-title">Beneficios de nuestro club</p>
        <div class="container column-section">
            <div class="item-section col-md-4">
                <div class="icon text-center"><i class="fa fa-3x fa-circle-o-notch"></i></div>
                <h4 class="item-title text-center">Servicios de primera calidad</h4>
                <p class="featured-text">
                    Sumérgete en el emocionante mundo del pádel en nuestro exclusivo club. Ofrecemos instalaciones de
                    primera clase y un ambiente acogedor para que disfrutes al máximo de tu experiencia. Nuestro
                    compromiso es brindarte partidas de pádel inolvidables, comunidad apasionada y momentos de diversión
                    sin igual." </p>
            </div>
            <div class="item-section col-md-4">
                <div class="icon text-center"><i class="fa fa-3x fa-life-ring"></i></div>
                <h4 class="item-title text-center">Reservas online</h4>
                <p class="featured-text">En nuestra plataforma, la reserva de pistas de pádel es rápida y sencilla.
                    Desde la comodidad de tu hogar, puedes seleccionar la pista, elegir la hora y confirmar tu reserva
                    en pocos pasos. Mantente al tanto de nuestras promociones y eventos especiales exclusivos
                    para miembros.</p>
            </div>
            <div class="item-section col-md-4">
                <div class="icon text-center"><i class="fa fa-3x fa-star"></i></div>
                <h4 class="item-title text-center">Accede a nuestra comunidad de padel</h4>
                <p class="featured-text">Al unirte a nuestro club, obtendrás acceso privilegiado a una comunidad
                    apasionada por el pádel. Además, forma parte de una red social de entusiastas del pádel,
                    compartiendo momentos inolvidables con
                    jugadores de todos los niveles. </p>
            </div>
        </div>

    </section>
    <!-- end Features -->


    <!-- Information -->
    <section id="menu-information" class="container information ">
        <h2 id="fittext2" class="title-start">Nuestras pistas</h2>
        <p class="sub-title">Las más populares.</p>
        @foreach($paddle_courts as $pc)
            <div class="item col-md-4">
                <div class="blok-read-sm">
                    <a href="{{route('paddleCourt.show',$pc->id)}}" class="hover-image">
                        <img src="{{asset('storage/' . $pc->image)}}" alt="image">
                        <span class="layer-block">{{$pc->name}}</span>
                    </a>
                    <div class="info-text visible-md visible-lg">
                        <span class="left-text">1 hora</span>
                        <span class="right-text">{{$pc->price}}€</span>
                    </div>
                    <div class="content-block">
                        <span class="point-caption bg-blue-point"></span>
                        <span class="bottom-line bg-blue-point"></span>
                        <h4>{{$pc->name}}</h4>
                        <p>{{\Illuminate\Support\Str::limit($pc->description,200) }}</p>
                        <a href="{{route('paddleCourt.show',$pc->id)}}" class="button-main bg-fio-point">Reserva ya</a>
                        <div class="like-wrap">
                                <i class="fa fa-comment col-green"></i><span
                                    style="color:black">{{count($pc->valorations)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>
    <section class="container information" style="display: initial">
        <div class="text-center">
            <a href="{{route('paddleCourt.index')}}" class="info">Ver todas</a>
        </div>
    </section>
    <!-- end Information -->


    </div>
@endsection
