@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h1 class="text-center">Cliente: {{ "{$cliente->nombre} {$cliente->segnombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</h1>
    <br>
    <h3 class="text-center">Dispositivos Instalados en el Vehículo</h3>
    <br>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('dispositivo.create')
        @if ($numerodedispositivos <= 0)
            <a href="{{ route('dispositivof.crear', $vehiculoid) }}" class="btn btn-warning">Asignar dispositivo</a>
        @endif
    @endcan

    @can('crear.cita')
        <a href="{{ route('crear.cita', $vehiculo) }}" class="btn btn-warning">Generar orden</a>
    @endcan

    <br><br>

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>ID en Platadorma</th>
                        <th>Cuenta</th>
                        <th>Modelo</th>
                        <th>IMEI</th>
                        <th>Fecha de Instalación</th>
                        <th>Comentarios</th>
                        <th>Lineas y Sensores</th>
                        @can('dispositivo.edit')
                            <th>Acciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dispositivo as $value)
                        <tr>
                            <td>{{ $value->plataforma_id }}</td>
                            <td>{{ $value->noeconomico }}</td>
                            <td>{{ $value->cuenta }}</td>
                            <td>{{ $value->modelo }}</td>
                            <td>{{ $value->imei }}</td>
                            <td>{{ $value->fechacompra }}</td>
                            <td>{{ $value->comentarios }}</td>
                            <td>
                                <a href="{{ route('buscar.linea', $value->id) }}" class="btn btn-primary">Linea</a>
                                <a href="{{ route('buscar.sensor', $value->id) }}" class="btn btn-primary">Sensor</a>
                            </td>
                            <td>
                                @can('dispositivo.edit')
                                    <a href="{{ route('dispositivo.edit', $value->id) }}" class="btn btn-warning">Editar</a>
                                @endcan
                                @can('dispositivo.destroy')
                                    <form action="{{ route('dispositivo.destroy', $value->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar?')">Borrar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <h3 class="text-center">Datos del Vehículo</h3>
    <br>
    <div class="card">
        <div class="card-body">
            <ul>
                <b>
                    Vehículo Marca: {{ $vehiculo->marca }}<br>
                    Modelo: {{ $vehiculo->modelo }}<br>
                    Número de Motor: {{ $vehiculo->nomotor }}<br>
                    Número de Serie: {{ $vehiculo->noserie }}<br>
                    Placa: {{ $vehiculo->placa }}<br>
                    Color: {{ $vehiculo->color }}<br>
                </b>
            </ul>
        </div>
    </div>
    <br>
    <a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-dark">Regresar</a>
@endsection
