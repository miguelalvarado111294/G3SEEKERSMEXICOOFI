@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Crear Cuenta Espejo</h3>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ctaespejop.crear', $id) }}" method="post">
                @csrf

                <div class="form-group">
                    <label>Usuario:</label>
                    <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}">
                    @error('usuario')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="text" class="form-control" name="contrasenia" value="{{ old('contrasenia') }}">
                    @error('contrasenia')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Comentarios:</label>
                    <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
                    @error('comentarios')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Enviar Datos">
                </div>
            </form>
        </div>
    </div>
@endsection
