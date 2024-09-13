@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Agregar Referencia</h3>
    <br>

    <form action=" {{ route('referenciap.crear', $id) }} " method="post">
        @csrf

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" class="form-control" name="nombre" value=" {{ old('nombre') }} ">
        </div>
        @error('nombre')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label> Segundo Nombre: </label>
            <input type="text" class="form-control" name="segnombre" value=" {{ old('segnombre') }} ">
        </div>

        @error('segnombre')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label>Apellido paterno:</label>
            <input type="text" class="form-control" name="apellidopat" value=" {{ old('apellidopat') }} ">
        </div>

        @error('apellidopat')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>


        <div class="form-group">
            <label> Apellido materno:</label>
            <input type="text" class="form-control" name="apellidomat" value=" {{ old('apellidomat') }} ">
        </div>

        @error('apellidomat')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label>Parentesco:</label>
            <input type="text" class="form-control" name="parentesco" value=" {{ old('parentesco') }} "> >
        </div>

        @error('parentesco')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label>Telefono:</label>
            <input type="text" class="form-control" name="telefono"value=" {{ old('telefono') }} "> >
        </div>

        @error('telefono')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label>Comentarios:</label>
            <input type="text" class="form-control" name="comentarios"value=" {{ old('comentarios') }} "> >
        </div>
        <br>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
    </div>
@endsection
