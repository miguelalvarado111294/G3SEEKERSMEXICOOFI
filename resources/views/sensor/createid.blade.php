@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ route('sensorp.crear', $id) }}" method="post">
            @csrf

            <div class="form-group">
                <label>Marca:</label>
                <input type="text" class="form-control" name="marca" value="{{ old('marca') }}">
            </div>
            <br>

            @error('marca')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Modelo : </label>
                <input type="text" class="form-control" name="modelo" value="{{ old('modelo') }}">
            </div>

            @error('modelo')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror

            <br>
            <div class="form-group">
                <label>Numero de Serie:</label>
                <input type="text" class="form-control" name="noserie" value="{{ old('noserie') }}">
            </div>
            <br>

            @error('noserie')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Tipo:</label>
                <input type="text" class="form-control" name="tipo" value="{{ old('tipo') }}">
            </div>
            <br>

            @error('tipo')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Comentarios:</label>
                <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
            </div>
            <br>

            @error('comentarios')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror


            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Enviar Datos">
        </form>
    </div>
    </div>
@endsection
