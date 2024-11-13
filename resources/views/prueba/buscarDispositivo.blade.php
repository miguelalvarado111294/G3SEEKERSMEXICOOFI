@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Condicional para mostrar botón "Asignar dispositivo" --}}
    @if ($numerodedispositivos <= 0)
        @can('dispositivo.create')
            <a href="{{ route('dispositivof.crear', $vehiculoid) }}" class="btn btn-warning">Asignar dispositivo</a>
        @endcan
    @endif

    {{-- Botón para generar orden --}}
    @can('crear.cita')
        <a href="{{ route('crear.cita', $vehiculo) }}" class="btn btn-warning">Generar orden</a>
    @endcan

    <br><br>
@endsection

@section('content')
<h4 class="text-center">
    {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}
</h4>
{{-- Fila para los dispositivos instalados y los datos del vehículo --}}
<div class="row justify-content-center">
    {{-- Card de dispositivos instalados --}}
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center"><strong>Datos de GPS instalado</strong></h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($dispositivo as $value)
                        <div class="col-md-12 mb-3">
                                
                                <div class="card-body">
                                    <p><strong>plataforma_id:</strong> {{ $value->plataforma_id }}</p>
                                    <p><strong>Cuenta:</strong> {{ $value->cuenta }}</p>
                                    <p><strong>Modelo:</strong> {{ $value->modelo }}</p>
                                    <p><strong>IMEI:</strong> {{ $value->imei }}</p>
                                    <p><strong>Fecha de Instalación:</strong> {{ $value->fechacompra }}</p>
                                    <p><strong>Comentarios:</strong> {{ $value->comentarios }}</p>
                                
                                    {{-- Ajustando el espaciado de los botones --}}
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('buscar.linea', $value->id) }}" class="btn btn-primary btn-sm mr-2">Linea</a>
                                        <a href="{{ route('buscar.sensor', $value->id) }}" class="btn btn-primary btn-sm">Sensor</a>
                                    </div>
                                </div>
                                

                                <div class="card-footer text-center">
                                    @can('dispositivo.edit')
                                        <a href="{{ url('/dispositivo/' . $value->id . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>
                                    @endcan

                                    @can('dispositivo.destroy')
                                        <form action="{{ url('/dispositivo/' . $value->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                        </form>
                                    @endcan
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Card de Datos del Vehículo --}}
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="text-center"><strong>Datos del Vehículo</strong></h3>
            </div>
            <div class="card-body text-center">
                <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
                <p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
                <p><strong>Número de Motor:</strong> {{ $vehiculo->nomotor }}</p>
                <p><strong>Número de Serie:</strong> {{ $vehiculo->noserie }}</p>
                <p><strong>Placa:</strong> {{ $vehiculo->placa }}</p>
                <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
            </div>
        </div>
    </div>
</div>

<br>

{{-- Botón de Regresar --}}
<a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-dark">Regresar</a>
@endsection
