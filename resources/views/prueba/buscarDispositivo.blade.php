@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <div class="text-center mb-4">
        <h1 class="display-4"><b>G3 Seekers México</b></h1>
        <h2 class="text-muted">Cliente: {{ "{$cliente->nombre} {$cliente->segnombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</h2>
        <h3 class="font-weight-bold text-primary">Dispositivos Instalados en el Vehículo</h3>
    </div>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('dispositivo.create')
        @if ($numerodedispositivos <= 0)
            <a href="{{ route('dispositivof.crear', $vehiculoid) }}" class="btn btn-warning btn-lg">
                <i class="fas fa-plus-circle"></i> Asignar dispositivo
            </a>
        @endif
    @endcan

    @can('crear.cita')
        <a href="{{ route('crear.cita', $vehiculo) }}" class="btn btn-warning btn-lg">
            <i class="fas fa-calendar-plus"></i> Generar orden
        </a>
    @endcan
    <br><br>
@endsection

@section('content')
    <!-- Tabla de Dispositivos -->
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-light">
                    <tr>
                        <th>ID en Plataforma</th>
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
                                <a href="{{ route('buscar.linea', $value->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-link"></i> Línea
                                </a>
                                <a href="{{ route('buscar.sensor', $value->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-sensor"></i> Sensor
                                </a>
                            </td>
                            <td class="text-center">
                                @can('dispositivo.edit')
                                    <a href="{{ route('dispositivo.edit', $value->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                @endcan
                                @can('dispositivo.destroy')
                                    <form action="{{ route('dispositivo.destroy', $value->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar?')">
                                            <i class="fas fa-trash-alt"></i> Borrar
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Datos del Vehículo -->
    <h3 class="text-center font-weight-bold text-primary">Datos del Vehículo</h3>
    <div class="card shadow-sm rounded">
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
    <a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-dark btn-lg">
        <i class="fas fa-arrow-left"></i> Regresar
    </a>
@endsection
