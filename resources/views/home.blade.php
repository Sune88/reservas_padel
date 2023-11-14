@extends('layouts.app')

@section("content")
    <div class="homepage">
    <!-- Slider and Form -->
    <section id="menu-slider" class="header">
        <div class="container">
            <div class="col-md-12 col-xs-12 col-sm-12 content_slider">
                <h1 id="fittext3" class="title-head text-center white">
                    Be a pro Sportsman
                </h1>

                <p class="sub-title-head text-center white">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.tempor incididunt ut
                    labore et dolore magna aliqua.
                </p>
                <div class="top-info text-center">
                    <button class="info">Learn More</button>
                    <button class="info">Purchase</button>
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
                    apasionada por el pádel. Además, forma parte de una red social de entusiastas del pádel, compartiendo momentos inolvidables con
                    jugadores de todos los niveles. </p>
            </div>
        </div>

    </section>
    <!-- end Features -->


    <!-- Information -->
    <section id="menu-information" class="container information generic">
        <h2 id="fittext2" class="title-start">Nuestras pistas</h2>
        <p class="sub-title">Las más populares.</p>
        @foreach($paddle_courts as $pc)
            <div class="item col-md-4">
                <div class="blok-read-sm">
                    <a href="{{route('paddleCourt.show',$pc->id)}}" class="hover-image">
                        <img src="{{$pc->image}}" alt="image">
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
                            <a href="#"><i class="fa fa-comment col-green"></i></a><span>{{count($pc->comments)}}</span>
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
    <!-- Countdown -->
    <section id="menu-countdown" class="countdown generic examples examples--styled">
        <h2 id="fittext2" class="title-start white">Countdown</h2>
        <p class="sub-title white">It's never too late, Get yourself Registered</p>
        <div class="container">
            <div class="contents">
                <!-- Valid global date and time string -->
                <div>
                    <time id="fittext2">2024-06-08T17:47:00+0100</time>
                </div><!-- Paris (winter) -->
            </div>
        </div>
    </section>
    <!-- end Countdown -->

    <!-- Testimonials -->
    <section id="menu-testimonial" class="testimonial">
        <div class="container">
            <h2 id="fittext2" class="title-start white">Testimonial</h2>
            <p class="sub-title white">Clients Feedback about us</p>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="item-image">
                            <img src="img/client3.jpg" class="img-circle" width="150" height="150" alt="...">
                        </div>
                        <div class="carousel-caption">
                            <span class="text-center head-text">Jane Doe</span><br/>
                            <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull
                            weather. Drops of rain.<i class="fa fa-quote-right"></i>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-image">
                            <img src="img/client1.jpg" class="img-circle" width="150" height="150" alt="...">
                        </div>
                        <div class="carousel-caption">
                            <span class="text-center head-text">Jane Doe</span><br/>
                            <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull
                            weather. Drops of rain.<i class="fa fa-quote-right"></i>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-image">
                            <img src="img/client2.jpg" class="img-circle" width="150" height="150" alt="...">
                        </div>
                        <div class="carousel-caption">
                            <span class="text-center head-text">Jane Doe</span><br/>
                            <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull
                            weather. Drops of rain.<i class="fa fa-quote-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-angle-left fa-2x" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-angle-right fa-2x" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- end Testimonials -->

    </div>
@endsection
