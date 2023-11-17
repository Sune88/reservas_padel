@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-12" style="text-align: center">
                <h1>Inicia sesión</h1>
            </div>
            <div class="col-md-6" style="margin: auto;float: unset">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label style="font-size: 12px" for="email" :value="__('Email')" />
                        <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-4">
                        <x-input-label style="font-size: 12px" for="password" :value="__('Password')" />

                        <x-text-input id="password" class="form-control block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" style="font-size: 12px" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600" style="font-size: 12px">Recuérdame</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a style="font-size: 12px"  class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                            ¿No estás registrado?
                        </a>
                        <x-primary-button class="ml-3" style="font-size: 12px">
                            ENTRAR
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
