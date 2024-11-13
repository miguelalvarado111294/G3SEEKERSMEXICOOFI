@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

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
