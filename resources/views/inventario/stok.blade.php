@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Stock</h3>
@stop

@section('content')
    <!-- Mostrar mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="form-group mt-4">
        <a href="{{route('inventarioadd')}}" class="btn btn-success">Añadir articulo al inventario </a>
    </div>

<h3>Dispositivos Disponibles</h3>
    <!-- Dispositivos Asociados -->
    @if($dispositivos->isEmpty())
        <p class="text-center">No hay dispositivos relacionados con este cliente.</p>
    @else
        <!-- Tabla de Dispositivos -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered mx-auto" style="max-width: 95%; background-color: #f8f9fa;">
                <thead class="thead-light">
                    <tr>
                        <th>Modelo</th>
                        <th>No. Serie</th>
                        <th>IMEI</th>
                        <th>Fecha de Compra</th>
                        <th>Precio</th>
                        <th>Comentarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dispositivos as $dispositivo)
                        <tr>
                            <td>{{ $dispositivo->modelo }}</td>
                            <td>{{ $dispositivo->noserie }}</td>
                            <td>{{ $dispositivo->imei }}</td>
                            <td>{{ $dispositivo->fechacompra }}</td>
                            <td>${{ $dispositivo->precio }}</td>
                            <td>{{ $dispositivo->comentarios }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h3>Lineas Disponibles</h3>

    <!-- Líneas Asociadas -->
    @if($lineas->isEmpty())
        <p class="text-center">No hay líneas asociadas a este cliente.</p>
    @else
        <!-- Tabla de Líneas -->
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover table-bordered mx-auto" style="max-width: 95%; background-color: #f8f9fa;">
                <thead class="thead-light">
                    <tr>
                        <th>Simcard</th>
                        <th>Telefono</th>
                        <th>Tipo de Línea</th>
                        <th>Renovación</th>
                        <th>Comentarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lineas as $linea)
                        <tr>
                            <td>{{ $linea->simcard }}</td>
                            <td>{{ $linea->telefono }}</td>
                            <td>{{ $linea->tipolinea }}</td>
                            <td>{{ $linea->renovacion }}</td>
                            <td>{{ $linea->comentarios }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="form-group mt-4 text-center">
        <a href="{{ URL::previous() }}" class="btn btn-secondary">Regresar</a>
    </div>
@stop
