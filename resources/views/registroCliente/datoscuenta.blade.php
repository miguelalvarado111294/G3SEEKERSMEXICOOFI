@extends('layouts.app') <!-- Cambia esto si tienes otro layout base -->

@section('title', 'G3 Seekers México')

@section('content')
<div class="container mt-5">
    <h1 class="text-center font-weight-bold">G3 Seekers México</h1>
    <h3 class="text-center">Creación de Cuenta</h3>
    <br>

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="text-center">Elija un nombre de cuenta y una contraseña</h4>
            <form action="{{ route('create.nuevo.cta', $id) }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario"
                           value="{{ isset($cuenta->usuario) ? $cuenta->usuario : old('usuario') }}" id="usuario">
                    @error('usuario')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" class="form-control" name="contrasenia"
                           value="{{ isset($cuenta->contrasenia) ? $cuenta->contrasenia : old('contrasenia') }}" id="contrasenia">
                    @error('contrasenia')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contraseniaParo">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="contraseniaParo"
                           value="{{ isset($cuenta->contraseniaParo) ? $cuenta->contraseniaParo : old('contraseniaParo') }}"
                           id="contraseniaParo">
                    @error('contraseniaParo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

              

                <div class="form-group text-center">
                    <button class="btn btn-success btn-lg" type="submit">Registrar Cuenta</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
