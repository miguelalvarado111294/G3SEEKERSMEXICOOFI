@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

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
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Datos de Sensores Instalados</h3>
    <br>

    <div class="card shadow-sm rounded mb-4 mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <p><b>Cliente:</b> {{ "{$cliente->segnombre} {$cliente->nombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</p>
            <p><b>Datos del Vehículo:</b> {{ "{$vehiculo->marca} Modelo: {$vehiculo->modelo} Placas: {$vehiculo->placa} Color: {$vehiculo->color}" }}</p>
            <p><b>Dispositivo GPS:</b></p>
            <p><b>Modelo:</b> {{ $dispositivo->modelo }}</p>
            <p><b>IMEI:</b> {{ $dispositivo->imei }}</p>
            <p><b>Número Económico:</b> {{ $dispositivo->noeconomico }}</p>
        </div>
    </div>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('sensor.create')
        <div class="text-center">
            <a href="{{ route('sensorf.crear', $id) }}" class="btn btn-success">Registrar Nuevo Sensor</a>
        </div>
    @endcan
<br>
    <div class="card shadow-sm rounded mb-4 mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Número de Serie</th>
                        <th>Tipo</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sensors as $sensor)
                        <tr>
                            <td>{{ $sensor->marca }}</td>
                            <td>{{ $sensor->modelo }}</td>
                            <td>{{ $sensor->noserie }}</td>
                            <td>{{ $sensor->tipo }}</td>
                            <td>{{ $sensor->comentarios }}</td>
                            <td>
                                @can('sensor.edit')
                                    <a href="{{ route('sensor.edit', $sensor->id) }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('sensor.destroy')
                                    <form action="{{ route('sensor.destroy', $sensor->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('buscar.dispositivo', $vehiculo->id) }}" class="btn btn-dark">Regresar</a>
@endsection

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