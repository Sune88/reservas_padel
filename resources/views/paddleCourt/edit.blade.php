@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12 col-md-6" style="margin: auto;float: unset">
                    <form method="POST" action="{{ route('paddlecourt.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$paddlecourt->id}}">
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required  for="name" :value="__('Nombre')" />
                            <input type="text" id="name" class="form-control block mt-1 w-full" name="name" value="{{$paddlecourt->name}}" required autofocus autocomplete="name" />
                        </div>
                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required for="description" :value="__('Descripcion')" />
                            <textarea id="description" class="form-control" name="description">{{$paddlecourt->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <img style="width: 150px;border-radius: 5px" src="{{asset('storage/' . $paddlecourt->image)}}">
                            <x-input-label style="font-size: 12px" required for="image" :value="__('Imagen')" />
                            <input accept="image/*" type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <x-input-label style="font-size: 12px" required  for="price" :value="__('Precio')" />
                            <input type="number" value="{{$paddlecourt->price}}" step="0.01" id="price" class="form-control block mt-1 w-full" name="price" :value="old('price')" required autocomplete="username" />
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
