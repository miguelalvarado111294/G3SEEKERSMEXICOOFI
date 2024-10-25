@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
    <h3 class="text-center">Ingrese datos para generar orden</h3>
@stop

@section('content')
    <form action="{{ route('ordenins') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Tipo de Línea:</label>
            <select name="cliente" class="form-control">
                <option value="">--Seleccione al Cliente--</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}</option>
                @endforeach
            </select>
        </div>

        <h3>Datos del Dispositivo</h3>

        @foreach (['modelo' => 'Modelo', 'imei' => 'IMEI', 'noeconomico' => 'Número Económico'] as $name => $label)
            <div class="form-group">
                <label>{{ $label }}:</label>
                <input type="text" class="form-control" name="{{ $name }}" value="{{ old($name) }}">
                @error($name)
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endforeach

        <h3>Datos de la Línea</h3>

        @foreach (['telefono' => 'Teléfono', 'simcard' => 'Sim Card'] as $name => $label)
            <div class="form-group">
                <label>{{ $label }}:</label>
                <input type="text" class="form-control" name="{{ $name }}" value="{{ old($name) }}">
                @error($name)
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endforeach

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
        </div>
    </form>
@stop
