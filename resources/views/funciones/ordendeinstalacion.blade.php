@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

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

@section('js')
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop