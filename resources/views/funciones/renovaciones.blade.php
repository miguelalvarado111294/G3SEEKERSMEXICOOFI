@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Dispositivos</h3>
@endsection

@section('content')
    <!-- Formulario para seleccionar el mes y año -->
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
                                <option value="1" {{ request('mes') == 1 ? 'selected' : '' }}>Enero</option>
                                <option value="2" {{ request('mes') == 2 ? 'selected' : '' }}>Febrero</option>
                                <option value="3" {{ request('mes') == 3 ? 'selected' : '' }}>Marzo</option>
                                <option value="4" {{ request('mes') == 4 ? 'selected' : '' }}>Abril</option>
                                <option value="5" {{ request('mes') == 5 ? 'selected' : '' }}>Mayo</option>
                                <option value="6" {{ request('mes') == 6 ? 'selected' : '' }}>Junio</option>
                                <option value="7" {{ request('mes') == 7 ? 'selected' : '' }}>Julio</option>
                                <option value="8" {{ request('mes') == 8 ? 'selected' : '' }}>Agosto</option>
                                <option value="9" {{ request('mes') == 9 ? 'selected' : '' }}>Septiembre</option>
                                <option value="10" {{ request('mes') == 10 ? 'selected' : '' }}>Octubre</option>
                                <option value="11" {{ request('mes') == 11 ? 'selected' : '' }}>Noviembre</option>
                                <option value="12" {{ request('mes') == 12 ? 'selected' : '' }}>Diciembre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="año">Año</label>
                            <select name="año" id="año" class="form-control">
                                <option value="">Seleccione un año</option>
                                <!-- Generar los últimos 10 años -->
                                @for ($i = 2020; $i <= now()->year; $i++)
                                    <option value="{{ $i }}" {{ request('año') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar los resultados -->
    @if ($dispositivos->isEmpty())
        <div class="alert alert-warning mt-4">
            <p>No se encontraron dispositivos para este mes y año.</p>
        </div>
    @else
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="card-title">Resultados de Selección</h5>
            </div>
            <div class="card-body">
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

@push('js')
<script>
    // Script para asegurarse que se envíe el formulario solo cuando ambos campos (mes y año) estén seleccionados
    document.getElementById('mes').addEventListener('change', function () {
        var mes = document.getElementById('mes').value;
        var año = document.getElementById('año').value;
        
        // Si ambos campos tienen valor, enviamos el formulario
        if (mes && año) {
            document.getElementById('mesAñoForm').submit();
        }
    });

    document.getElementById('año').addEventListener('change', function () {
        var mes = document.getElementById('mes').value;
        var año = document.getElementById('año').value;
        
        // Si ambos campos tienen valor, enviamos el formulario
        if (mes && año) {
            document.getElementById('mesAñoForm').submit();
        }
    });
</script>
@endpush
