@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li style="text-align: center">{{session()->get('error')}}</li>
                            </ul>
                        </div>
                    @endif
                        @if(session('status'))
                            <div class="alert alert-success">
                                <ul>
                                    <li style="text-align: center">{{session()->get('status')}}</li>
                                </ul>
                            </div>
                        @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="text-align: center">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-12" style="text-align: center">
                    <!-- Contact-->
                    <section id="menu-contact" class="container contact">
                        <h2 id="fittext2" class="title-start">Contáctanos</h2>
                        <p class="sub-title">Contáctanos para lo que necesites...</p>
                        <div class="map col-md-6 col-sm-6 col-xs-12">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2825.211958629328!2d91.83379900000003!3d24.909438007883935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37505558dd0be6a1%3A0x65c7e47c94b6dc45!2sTechnext!5e1!3m2!1sen!2s!4v1425297675833"
                                width="100%" height="354" frameborder="0" style="border:0">
                            </iframe>
                        </div>
                        <div class="contact-form-full col-md-6 col-sm-6 col-xs-12">
                            <div class="inner contact">
                                <!-- Form Area -->
                                <div class="contact-form">
                                    <!-- Form -->
                                    <form id="contact-us" method="post" action="{{route('contact.send')}}">
                                        <!-- Left Inputs -->
                                        @csrf
                                        <div class="col-xs-12 wow animated slideInLeft" data-wow-delay=".5s">
                                            <!-- Name -->
                                            <input type="text" name="name" id="name" required="required" class="form"
                                                   placeholder="Nombre"/>
                                            <!-- Email -->
                                            <input type="email" name="email" id="email" required="required" class="form"
                                                   placeholder="Email"/>

                                        </div><!-- End Left Inputs -->
                                        <!-- Right Inputs -->
                                        <div class="col-xs-12 wow animated slideInRight" data-wow-delay=".5s">
                                            <!-- Message -->
                                            <textarea name="message" id="message" class="form textarea"
                                                      placeholder="Mensaje"></textarea>
                                        </div><!-- End Right Inputs -->
                                        <!-- Bottom Submit -->
                                        <div class="relative fullwidth col-xs-12">
                                            <!-- Send Button -->
                                            <button type="submit" id="submit" name="submit" class="form-btn semibold">Enviar mensaje
                                            </button>
                                        </div><!-- End Bottom Submit -->
                                        <!-- Clear -->
                                        <div class="clear"></div>
                                    </form>

                                </div><!-- End Contact Form Area -->
                            </div><!-- End Inner -->
                        </div>
                    </section>
                    <!-- end Contact -->
                </div>
            </div>
        </div>
    </div>
@endsection
