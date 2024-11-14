@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h1 class="text-center">Cliente: {{ "{$cliente->nombre} {$cliente->segnombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</h1>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible text-center" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="text-center mb-4">
        <!-- Botón Historial -->
        <a href="{{ route('historial', $vehiculo->id) }}" class="btn btn-info">Historial</a>
    </div>

    @can('dispositivo.create')
        @if ($numerodedispositivos <= 0)
            <div class="text-center">
                <a href="{{ route('dispositivof.crear', $vehiculoid) }}" class="btn btn-warning">Asignar dispositivo</a>
            </div>
        @endif
    @endcan

    @can('crear.cita')
        <div class="text-center">
            <a href="{{ route('crear.cita', $vehiculo) }}" class="btn btn-warning">Generar orden</a>
        </div>
    @endcan

    <br>

    <!-- Contenedor con flexbox para centrar las tarjetas -->
    <div class="row justify-content-center">
        @foreach ($dispositivo as $value)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <b>Dispositivo Instalado</b>
                    </div>
                    <div class="card-body">
                        <p><strong>platadorma_id:</strong> {{ $value->plataforma_id }}</p>

                        <p><strong>noeconomico:</strong> {{ $value->noeconomico }}</p>
                        <p><strong>Cuenta:</strong> {{ $value->cuenta }}</p>
                        <p><strong>Modelo:</strong> {{ $value->modelo }}</p>
                        <p><strong>IMEI:</strong> {{ $value->imei }}</p>
                        <p><strong>Fecha de Instalación:</strong> {{ $value->fechacompra }}</p>
                        <p><strong>ubicaciondispositivo:</strong> {{ $value->ubicaciondispositivo }}</p>
                        <p><strong>Sucursal:</strong> {{ $value->sucursal }}</p>
                        
                        <p><strong>Observaciones:</strong> {{ $value->comentarios }}</p>
                        <br>
                        <div class ="text-center"> 
                            <a href="{{ route('buscar.linea', $value->id) }}" class="btn btn-primary btn-sm">Linea</a>
                            <a href="{{ route('buscar.sensor', $value->id) }}" class="btn btn-primary btn-sm">Sensor</a>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        @can('dispositivo.edit')
                            <a href="{{ route('dispositivo.edit', $value->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        @endcan
                        @can('dispositivo.destroy')
                            <form action="{{ route('dispositivo.destroy', $value->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar?')">Borrar</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <!-- Contenedor para centrar los datos del vehículo -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <b>Detalles del Vehículo</b>
                </div>
                <div class="card-body text-center">
                    <ul class="list-unstyled">
                        <li><b>Vehículo Marca:</b> {{ $vehiculo->marca }}</li>
                        <li><b>Modelo:</b> {{ $vehiculo->modelo }}</li>
                        <li><b>Número de Motor:</b> {{ $vehiculo->nomotor }}</li>
                        <li><b>Número de Serie:</b> {{ $vehiculo->noserie }}</li>
                        <li><b>Placa:</b> {{ $vehiculo->placa }}</li>
                        <li><b>Color:</b> {{ $vehiculo->color }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-dark">Regresar</a>
    </div>
@endsection
