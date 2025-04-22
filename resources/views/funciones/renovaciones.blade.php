@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Consultar Renovaciones</h3>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Selecciona el Mes y Año</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('renovacionessearch') }}" method="GET" id="mesAñoForm">
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
                        <div class="form-group">
                            <label for="año">Año</label>
                            <select name="año" id="año" class="form-control">
                                <option value="">Seleccione un año</option>
                                @for ($i = 2020; $i <= now()->year; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    @if(request()->has('mes') && request()->has('año') && isset($dispositivos))
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title">Resultados de Selección</h5>
            </div>
            <div class="card-body">
                @if(!$dispositivos->isEmpty())
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Plataforma ID</th>
                                <th>Fecha de Compra</th>
                                <th>Dispositivo</th>
                                <th>Cliente</th>
                                <th>Vehículo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dispositivos as $dispositivo)
                                <tr>
                                    <td>{{ $dispositivo->plataforma_id }}</td>
                                    <td>{{ $dispositivo->fechacompra }}</td>
                                    <td>{{ $dispositivo->modelo }}</td>
                                    <td>
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
                    <div class="d-flex justify-content-center">
                        {{ $dispositivos->appends(request()->all())->links() }}
                    </div>

                @else
                    <div class="alert alert-warning">No se encontraron dispositivos para este mes y año.</div>
                @endif
            </div>
        </div>
    @endif

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@endsection