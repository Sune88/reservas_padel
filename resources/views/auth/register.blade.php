@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-12" style="text-align: center">
                <h1>Registro</h1>
            </div>
            <div class="col-md-6" style="margin: auto;float: unset">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <x-input-label style="font-size: 12px"  for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- lastname -->
                    <div class="form-group">
                        <x-input-label style="font-size: 12px" for="lastname" :value="__('Apellidos')" />
                        <x-text-input id="lastname" class="form-control block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label style="font-size: 12px"  for="email" :value="__('Email')" />
                        <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label style="font-size: 12px" for="password" :value="__('Contraseña')" />

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

                    <div class="flex items-center justify-end mt-4">
                        <a style="font-size: 12px"  class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            ¿Ya estás registrado?
                        </a>

                        <x-primary-button style="font-size: 12px" class="ml-4">
                           REGISTRAR
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
