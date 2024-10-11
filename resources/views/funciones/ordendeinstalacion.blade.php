@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Ingrese datos para generar orden</h3>
@stop
@section('content')

    <form action=" {{ route('ordenins') }} " method="post">
        @csrf

        <div class="form-group">
            <label>Tipo de Linea:</label>
            <select name="cliente" class="form-control">
                <option value="">--Selecciones al Cliente--</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"> {{ $cliente->nombre }} {{ $cliente->segnombre }}
                        {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}
                    </option>
                @endforeach
            </select>

            <h3>Datos del Dispositivo</h3>

            <div class="form-group">
                <label>Modelo:</label>
                <input type="text" class="form-control" name="modelo" value=" {{ old('modelo') }}">
            </div>
            @error('modelo')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
            <br>

            <div class="form-group">
                <label>Imei:</label>
                <input type="text" class="form-control" name="imei"value=" {{ old('imei') }}">
                @error('imei')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>

            <div class="form-group">
                <label>numero Economico:</label>
                <input type="text" class="form-control" name="noeconomico"value=" {{ old('noeconomico') }}">
                @error('noeconomico')
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>




            <h3>Datos de la Linea</h3>

            <div class="form-group">
                <label>Telefono : </label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">
            </div>
            @error('telefono')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>

            <div class="form-group">
                <label>Sim Card:</label>
                <input type="text" class="form-control" name="simcard" value="{{ old('simcard') }}">
            </div>
            @error('simcard')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>



            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Enviar Datos">
            </div>
    </form>
    </div>

    </div>
@endsection
