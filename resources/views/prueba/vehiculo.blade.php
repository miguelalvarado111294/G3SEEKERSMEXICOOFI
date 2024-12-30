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
        <h1 class="display-4"><b>G3 Seekers México</b></h1>
        <h2 class="text-muted">Cliente: {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}</h2>
        <h4 class="text-muted">Cuenta: {{ $cuenta->pluck('usuario')->implode(', ') }}</h4>
        <h3 class="font-weight-bold text-primary">Vehículo(s)</h3>
    </div>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('vehiculo.create')
        <div class="text-center mb-4">
            <a href="{{ route('vehiculof.crear', $id) }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus-circle"></i> Registrar nuevo vehículo
            </a>
        </div>
    @endcan
@endsection

@section('content')
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Id del vehículo</th>
                        <th>Fecha de instalación</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Placa</th>
                        <th>Tipo de Unidad</th>
                        <th>Número de Serie</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{ $vehiculo->id }}</td>
                            <td>{{ $vehiculo->fechacompra ?? 'N/A' }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->color }}</td>
                            <td>{{ $vehiculo->placa }}</td>
                            <td>{{ $vehiculo->tipo }}</td>
                            <td>{{ $vehiculo->noserie }}</td>
                            <td class="text-center">
                                @can('vehiculo.edit')
                                    <a href="{{ route('vehiculo.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                @endcan

                                @can('vehiculo.destroy')
                                    <form action="{{ route('vehiculo.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro quieres eliminar?')">
                                            <i class="fas fa-trash-alt"></i> Borrar
                                        </button>
                                    </form>
                                @endcan

                                <a href="{{ route('buscar.dispositivo', $vehiculo->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-cogs"></i> Dispositivo
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {!! $vehiculos->links() !!}
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('buscar.cuenta', $cliente_id) }}" class="btn btn-dark btn-lg">
            <i class="fas fa-arrow-left"></i> Regresar
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