@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Dispositivos</h3>
@endsection

@section('content')
    <!-- Formulario para seleccionar el mes -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Selecciona el mes</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('renovacionessearch') }}" method="GET">
                        <div class="form-group">
                            <label for="mes">Mes</label>
                            <select name="mes" id="mes" class="form-control">
                                <option value="">Seleccione un mes</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar los resultados -->
    @if ($dispositivos->isEmpty())
        <div class="alert alert-warning mt-4">
            <p>No se encontraron dispositivos para este mes.</p>
        </div>
    @else
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title">Resultados de Dispositivos</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha de Compra</th>
                            <th>Dispositivo</th>
                            <th>Cliente</th>
                            <th>Vehículo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dispositivos as $dispositivo)
                            <tr>
                                <td>{{ $dispositivo->id }}</td>
                                <td>{{ $dispositivo->fechacompra }}</td>
                                <td>{{ $dispositivo->modelo }}</td>
                                <td>
                                    {{-- Concatenar nombre completo del cliente --}}
                                    @if($dispositivo->cliente)
                                        {{ $dispositivo->cliente->nombre }} 
                                        @if($dispositivo->cliente->segundo_nombre) 
                                            {{ $dispositivo->cliente->segundo_nombre }} 
                                        @endif
                                        {{ $dispositivo->cliente->apellidopat }} 
                                        {{ $dispositivo->cliente->apellidomat }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    {{-- Mostrar marca y modelo del vehículo --}}
                                    @if($dispositivo->vehiculo)
                                        {{ $dispositivo->vehiculo->marca }} 
                                        {{ $dispositivo->vehiculo->modelo }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
