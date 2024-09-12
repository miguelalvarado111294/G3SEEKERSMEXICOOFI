@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Datos Personales</h3>
    <br>

    crear cta espejo

    <form action=" {{ route('ctaespejop.crear', $id) }} " method="post">
        @csrf

        <div class="form-group">
            <label>Usuario:</label>
            <input type="text" class="form-control" name="usuario">
        </div>
        <br>

        <div class="form-group">
            <label> Contraseña : </label>
            <input type="text" class="form-control" name="contrasenia">
        </div>
        <br>

        <div class="form-group">
            <label> Comentarios:</label>
            <input type="text" class="form-control" name="comentarios">
        </div>
        <br>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
@endsection
