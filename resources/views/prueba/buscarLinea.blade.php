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
    <div class="text-center mb-4">
        <h1><strong>G3 Seekers México</strong></h1>
        <h3>Líneas</h3>

    </div>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('linea.create')
        @if ($numerodelineas <= 0)
            <div class="text-center">
                <a href="{{ route('lineaf.crear', $dispositivoid) }}" class="btn btn-success mb-3">
                    Registrar Nueva Línea
                </a>
            </div>
        @endif
    @endcan
@endsection

@section('content')
    <!-- Mostrando las líneas en cards -->
    @foreach ($lineas as $linea)
        <div class="card shadow-sm rounded mb-4 mx-auto" style="max-width: 600px;">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0"><b>Cliente: {{ "{$cliente->nombre} {$cliente->segnombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</h4>
                </b></h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled text-center">
                    <li><b>Teléfono:</b> {{ $linea->telefono }}</li>
                    <li><b>Simcard:</b> {{ $linea->simcard }}</li>
                    <li><b>Tipo de Línea:</b> {{ $linea->tipolinea }}</li>
                    <li><b>Fecha de Contratación:</b> {{ $linea->renovacion }}</li>
                    <li><b>Comentarios:</b> {{ $linea->comentarios }}</li>
                </ul>

                <div class="text-center">
                    @can('linea.edit')
                        <a href="{{ route('linea.edit', $linea->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @endcan
                    @can('linea.destroy')
                        <form action="{{ route('linea.destroy', $linea->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro quieres eliminar?')">
                                <i class="fas fa-trash-alt"></i> Borrar
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    @endforeach

    <div class="text-center mt-3">
        <a href="{{ route('buscar.dispositivo', $vehiculoid) }}" class="btn btn-dark">
            Regresar
        </a>
    </div>
@endsection

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