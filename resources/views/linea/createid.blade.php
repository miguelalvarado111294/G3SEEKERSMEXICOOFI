@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Datos Personales</h3>
    <br>

    <form action="{{ route('lineap.crear', $id) }}" method="post">
        @csrf

        <div class="form-group">
            <label>Sim Card:</label>
            <input type="text" class="form-control" name="simcard" value="{{ old('simcard') }}">
        </div>
        @error('simcard')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>

        <br>

        <div class="form-group">
            <label>Telefono : </label>
            <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">
        </div>
        @error('telefono')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label for="tipolinea">Tipo de Línea:</label>
            <input type="text" class="form-control" name="tipolinea" id="tipolinea" required>
        </div>
        
        @error('tipolinea')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>
        <div class="form-group">
            <label for="renovacion">Renovación:</label>
            <input type="date" class="form-control" name="renovacion" id="renovacion" value="{{ old('renovacion') }}">
        </div>
        @error('renovacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <br>
        
        <br>


        <div class="form-group">
            <label> Comentarios:</label>
            <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
        </div>
        @error('comentarios')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
@endsection
