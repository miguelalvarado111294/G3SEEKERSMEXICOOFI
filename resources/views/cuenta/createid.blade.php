@extends('layouts.app')
@section('content')
    <div class="container">



        <h1>Crear Cuenta de Cliente</h1>

        <form action=" {{ route('cuentap.crear', $id) }} " method="post">
            @csrf

            <div class="form-group">
                <label>Usuario:</label>
                <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}">
            </div>
            @error('usuario')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
            <br>

            <div class="form-group">
                <label> Contraseña : </label>
                <input type="text" class="form-control" name="contrasenia"value="{{ old('contrasenia') }}">
            </div>
            @error('contrasenia')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
            <br>

            <div class="form-group">
                <label>Contraseña de Paro:</label>
                <input type="text" class="form-control" name="contraseniaParo" value="{{ old('contraseniaParo') }}">
            </div>
            @error('contraseniaParo')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
            <br>


            <div class="form-group">
                <label> Comentarios:</label>
                <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
            </div>
            @error('comentarios')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
            <br>


            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Enviar Datos">
        </form>
    </div>
    </div>
@endsection
