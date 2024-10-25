@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
    <h3 class="text-center">Clientes</h3>
@stop

@section('content')
    <h1>Agregar Nuevo Usuario</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="name" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Añadir Usuario</button>
                </div>
            </form>
        </div>
    </div>
@stop
