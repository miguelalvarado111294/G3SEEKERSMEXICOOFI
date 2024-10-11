@extends('adminlte::page')
@section('title', 'G3SEEKERSMX')
@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Creacion de Cuenta</h3>
    <br>
    <div class="card">
        <div class="card-body">{{ $id }}
        


            <h4>Elija un nombre de cuenta y una contraseña</h4>
            <form action=" {{ route('create.nuevo.cta', $id) }} " method="post">
                @csrf

            <div class="form-group">
                <label for="usuario">usuario</label>
                <input type="text" class="form-control" name="usuario"
                    value="{{ isset($cuenta->usuario) ? $cuenta->usuario : old('usuario') }}" id="usuario">
                @error('usuario')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>

            <div class="form-group">
                <label for="contrasenia">contrasenia</label>
                <input type="text" class="form-control" name="contrasenia"
                    value="{{ isset($cuenta->contrasenia) ? $cuenta->contrasenia : old('contrasenia') }}" id="contrasenia">
                @error('contrasenia')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>

            <div class="form-group">
                <label for="contraseniaParo">contraseniaParo</label>
                <input type="text" class="form-control" name="contraseniaParo"
                    value="{{ isset($cuenta->contraseniaParo) ? $cuenta->contraseniaParo : old('contraseniaParo') }}"
                    id="contraseniaParo">
                @error('contraseniaParo')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>

            <div class="form-group">
                <label for="comentarios">comentarios</label>
                <input type="text" class="form-control" name="comentarios"
                    value="{{ isset($cuenta->comentarios) ? $cuenta->comentarios : old('comentarios') }}" id="comentarios">
                @error('comentarios')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>
            <div class="form-group">
                <input class="btn btn-success" type="submit" class="form-control">
            </div>
        @endsection

    </div>
</div>
