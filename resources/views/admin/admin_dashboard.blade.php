@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row mb-6">
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
                <div class="col-12 col-md-12" style="text-align: center">
                    <h2>Usuarios</h2>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal_crear_usuario">Crear usuario</button>
                </div>
                <div class="col-12 col-md-12" style="text-align: center;max-height: 400px;overflow: auto">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Email</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->rol->name}}</td>
                                <td><img style="width: 60px"
                                         src="{{ $user->avatar !=null? asset('storage/' . $user->avatar) : "http://ssl.gstatic.com/accounts/ui/avatar_2x.png"}}">
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button class="btn btn-danger btnEliminarUsuario" data-user_id="{{$user->id}}">
                                        Eliminar
                                    </button>
                                    <form id="formEliminarUsuario_{{$user->id}}"
                                          action="{{route('user.destroy',$user->id)}}" method="get">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row mb-6">
                <div class="col-12 col-md-12" style="text-align: center;max-height: 400px;overflow: auto">
                    <h2>Pistas</h2>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal_crearpista">Crear pista</button>
                </div>
                <div class="col-12 col-md-12" style="text-align: center">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Precio/h</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paddleCourts as $pc)
                        <tr>
                            <td>{{$pc->id}}</td>
                            <td>
                                <img style="width: 60px"
                                     src="{{asset('storage/' .$pc->image) }}">
                            </td>
                            <td>{{$pc->name}}</td>
                            <td>{{$pc->description}}</td>
                            <td>{{$pc->price}}€</td>
                            <td>
                                <a href="{{route('paddlecourt.edit',$pc->id)}}" class="btn btn-warning" data-paddleCourt_id="{{$pc->id}}">
                                    Editar
                                </a>
                                <button class="btn btn-danger btnEliminarPista" data-paddleCourt_id="{{$pc->id}}">
                                    Eliminar
                                </button>
                                <form id="formEliminarPista_{{$pc->id}}"
                                      action="{{route('paddlecourt.destroy',$pc->id)}}" method="get">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row mb-6">
                <div class="col-12 col-md-12" style="text-align: center">
                    <h2>Reservas</h2>
                </div>
                <div class="col-12 col-md-12" style="text-align: center;max-height: 400px;overflow: auto">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Payment_id</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Pista</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora entrada</th>
                            <th scope="col">Hora salida</th>
                            <th scope="col">Total</th>
                            <th scope="col">Pagado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{$booking->payment_id}}</td>
                                <td>{{$booking->user->email}}</td>
                                <td>{{$booking->paddle_court->name}}</td>
                                <td>{{$booking->state->name}}</td>
                                <td>{{\Carbon\Carbon::parse($booking->date)->format("d-m-Y")}}</td>
                                <td>{{\Carbon\Carbon::parse($booking->hour_start)->format("H:i")}}</td>
                                <td>{{\Carbon\Carbon::parse($booking->hour_end)->format("H:i")}}</td>
                                <td>{{$booking->total_amount}}€</td>
                                <td>{{$booking->paid==1 ? 'Si':'No'}}</td>
                                <td>
                                    <button class="btn btn-danger btnEliminarReserva"
                                            data-booking_id="{{$booking->id}}">Eliminar
                                    </button>
                                    <form id="formEliminarReserva_{{$booking->id}}"
                                          action="{{route('booking.destroy',$booking->id)}}" method="get">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row mb-6">
                <div class="col-12 col-md-12" style="text-align: center">
                    <h2>Contactos</h2>
                </div>
                <div class="col-12 col-md-12" style="text-align: center;max-height: 400px;overflow: auto">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mensaje</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td style="text-align: left">{{$contact->message}}</td>
                                <td>
                                    <button class="btn btn-danger btnEliminarContacto"
                                            data-contact_id="{{$contact->id}}">Eliminar
                                    </button>
                                    <form id="formEliminarContacto_{{$contact->id}}"
                                          action="{{route('contact.destroy',$contact->id)}}" method="get">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_crear_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crear usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <!-- Name -->
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required  for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
                        <!-- lastname -->
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required for="lastname" :value="__('Apellidos')" />
                            <x-text-input id="lastname" class="form-control block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />

                        </div>
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required for="rol" :value="__('Rol')" />
                            <select name="rol" class="form-control" required>
                                @foreach(\App\Models\Role::all() as $rol)
                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Email Address -->
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required  for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required for="password" :value="__('Contraseña')" />

                            <x-text-input id="password" class="form-control block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <x-input-label style="font-size: 12px"  for="password_confirmation" :value="__('Confirmar contraseña')" />

                            <x-text-input id="password_confirmation" class="form-control block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_crearpista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Crear pista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('paddlecourt.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required  for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required for="description" :value="__('Descripción')" />
                            <textarea id="description" class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required for="image" :value="__('Imagen')" />
                            <input accept="image/*" type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required  for="price" :value="__('Precio')" />
                            <input type="number" value="1.00" step="0.01" id="price" class="form-control block mt-1 w-full" name="price" :value="old('price')" required autocomplete="username" />
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.btnEliminarUsuario').click(function (e) {
                var user_id = e.currentTarget.dataset.user_id;
                if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                    // Si el usuario confirma, envía el formulario
                    $('#formEliminarUsuario_' + user_id).submit();
                }
            });
            $('.btnEliminarContacto').click(function (e) {
                var contact_id = e.currentTarget.dataset.contact_id;
                if (confirm('¿Estás seguro de que deseas eliminar este contacto?')) {
                    // Si el usuario confirma, envía el formulario
                    $('#formEliminarContacto_' + contact_id).submit();
                }
            });
            $('.btnEliminarReserva').click(function (e) {
                var booking_id = e.currentTarget.dataset.booking_id;
                console.log(booking_id)
                if (confirm('¿Estás seguro de que deseas eliminar esta reserva?')) {
                    // Si el usuario confirma, envía el formulario
                    $('#formEliminarReserva_' + booking_id).submit();
                }
            });
            $('.btnEliminarPista').click(function (e) {
                var paddleCourt_id = e.currentTarget.dataset.paddlecourt_id;
                console.log(e.currentTarget.dataset)
                if (confirm('¿Estás seguro de que deseas eliminar esta pista?')) {
                    // Si el usuario confirma, envía el formulario
                    $('#formEliminarPista_' + paddleCourt_id).submit();
                }
            });
        });
    </script>
@endsection
