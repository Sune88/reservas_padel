@extends('layouts.app')

@section("content")
    <style>
        .label{
            padding: unset;
            color:black;
            font-size: 100%;
        }
        #input_text{
            resize: none;
        }
    </style>
    <div class="container mt-4 mb-6">
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
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            <ul>
                                <li style="text-align: center">{{session()->get('warning')}}</li>
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
            <div class="col-sm-12 text-center">
                <h1>Mi perfil</h1>
            </div>
        </div>
        <div class="row">
            <form action="{{route('profile.update')}}" method="post" id="registrationForm"
                  enctype="multipart/form-data">

                <div class="col-sm-3"><!--left col-->
                    <div class="text-center">
                        <img style="width: 250px; height: 250px;object-fit: cover;border-radius: 5%;"
                             src="{{ $user->avatar !=null? asset('storage/' . $user->avatar) : "http://ssl.gstatic.com/accounts/ui/avatar_2x.png"}}"
                             class="avatar  img-thumbnail"
                             alt="avatar">
                        <h6>Elige una imágen.</h6>
                        <input type="file" style="width: 100%" name="avatar" accept="image/*"
                               class="center-block file-upload">
                    </div>
                    <br>

                </div><!--/col-3-->
                <div class="col-sm-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            @csrf
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="first_name"><h4>Nombre</h4></label>
                                    <input type="text" class="form-control" required name="name"
                                           value="{{$user->name}}" id="name"
                                           placeholder="nombre">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name"><h4>Apellidos</h4></label>
                                    <input type="text" class="form-control" required value="{{$user->lastname}}"
                                           name="lastname" id="lastname"
                                           placeholder="apellidos">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email"><h4>Email</h4></label>
                                    <input type="email" class="form-control" required value="{{$user->email}}"
                                           name="email" id="email"
                                           placeholder="tuemail@email.com">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password"><h4>Contraseña</h4></label>
                                    <small>Dejar en blanco para mantener la misma.</small>
                                    <input type="password" class="form-control" autocomplete="new-password"
                                           name="password" id="password"
                                           placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="password2"><h4>Confirmar contraseña</h4></label>
                                    <input type="password" class="form-control" autocomplete="new-password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           placeholder="Confirmar contraseña">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn  btn-success" type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Guardar
                                    </button>
                                </div>
                            </div>


                            <hr>

                        </div>
                    </div><!--/tab-pane-->
                </div><!--/tab-content-->
            </form>
            <div class="col-sm-12 text-center mt-4 mb-4">
                <h1>Mis reservas</h1>
            </div>
            <div class="col-12 mb-6">
                @if(count($bookings)>0)
                    <div class="table-responsive">
                        <table class="table" style="text-align: center">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pista</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora de entrada</th>
                                <th scope="col">Hora de salida</th>
                                <th scope="col">Precio total</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{$booking->id}}</td>
                                    <td>{{$booking->paddle_court->name}}</td>
                                    <td>{{$booking->date}}</td>
                                    <td>{{\Carbon\Carbon::parse($booking->hour_start)->format("H:i")}}</td>
                                    <td>{{\Carbon\Carbon::parse($booking->hour_end)->format("H:i")}}</td>
                                    <td>{{number_format($booking->total_amount,2)}}€</td>
                                    <td>{{$booking->state->name}}</td>
                                    <td>
                                        @if($booking->paid == 0 && $booking->booking_state_id == 1)
                                            <form action="{{route('charge')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                                <button type="submit" class="btn btn-warning">Pagar reserva</button>
                                            </form>

                                            <a href="{{route('cancel.booking',$booking->id)}}" class="btn btn-danger">Cancelar reserva</a>
                                        @else
                                            <a class="btn btn-info valorar_link" data-paddle_court_id="{{$booking->paddle_court->id}}" data-toggle="modal" data-target="#valorar_modal" class="btn btn-primary">Valorar</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                @else
                    <p style="text-align: center">No tienes ninguna reserva.</p>
                @endif
            </div>

        </div><!--/col-9-->
    </div><!--/row-->
    <!-- Modal -->
    <div class="modal fade" id="valorar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Valorar esta pista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label">Valoración:</label>
                        <select id="input_valoracion" required name="valoracion" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label">Comentarios:</label>
                        <textarea class="form-control" required name="text" id="input_text">

                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button id="enviarValoracion" type="button" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#input_text').val("")
            var paddle_court_id_valorar;
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.avatar').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".file-upload").on('change', function () {
                readURL(this);
            });

            $('.valorar_link').click((e)=>{
                paddle_court_id_valorar = e.currentTarget.dataset.paddle_court_id;
            })
            $('#enviarValoracion').click((e)=>{
                var url = '{{route('rate.paddlecourt')}}'
                const data = {
                    paddle_court_id: paddle_court_id_valorar,
                    rate: $('#input_valoracion').val(),
                    text: $('#input_text').val(),
                    _token : '{{csrf_token()}}'
                };
                console.log(data)
                fetch(url,{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#input_valoracion').val(1);
                        $('#input_text').val("");
                        toastr.success(data.message)
                        $('#valorar_modal').modal('toggle')
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            })

        });
    </script>
@endsection
