@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Clientes</h3>
@stop

@section('content')
    <h1>Agregar Nuevo Usuario</h1>

<div class="card">
    <div class="card-body">



        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="name" required>
                @error('name')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
            </div>
    
            <div>
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('email')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
            </div>
    

            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" class="form-control" value="Añadir Usuario">
                    </div>
                </div>
            </div>




        </form>

    </div>
</div>


@stop
