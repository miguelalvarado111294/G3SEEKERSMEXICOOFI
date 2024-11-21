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
                                @for ($i = 2020; $i <= now()->year; $i++)
                                    <option value="{{ $i }}" {{ request('año') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Botón de Buscar -->
                        <button type="submit" id="buscarBtn" class="btn btn-success w-100" disabled>Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mostrar los resultados (ocultar inicialmente) -->
    <div id="resultados" style="display: none;">
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
                </div>
            </div>
        @endif
    </div>
@endsection

@push('js')
<script>
    // Función que habilita el botón de "Buscar" cuando mes y año son seleccionados
    function checkSelection() {
        var mes = document.getElementById('mes').value;
        var año = document.getElementById('año').value;
        
        // Si ambos están seleccionados, habilitar el botón
        if (mes && año) {
            document.getElementById('buscarBtn').disabled = false;
        } else {
            document.getElementById('buscarBtn').disabled = true;
        }
    }

    // Detectar cambios en los selects y ejecutar checkSelection
    document.getElementById('mes').addEventListener('change', checkSelection);
    document.getElementById('año').addEventListener('change', checkSelection);

    // Mostrar los resultados una vez que se haya enviado el formulario
    @if(request('mes') && request('año'))
        document.getElementById('resultados').style.display = 'block';
    @endif
</script>
@endpush

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