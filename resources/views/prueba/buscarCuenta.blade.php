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
    <h4 class="text-center">
        {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}
    </h4>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($numerodecuentas <= 0 && Auth::user()->can('cuenta.create'))
        <a href="{{ route('cuentaf.crear', $cliente_id) }}" class="btn btn-success">Registrar nueva cuenta</a>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <!-- Centrar las tarjetas usando d-flex y justify-content-center -->
            <div class="row justify-content-center">
                @foreach ($cuenta as $value)
                    <div class="col-md-4 mb-3">
                        <!-- Card for each account -->
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title">Credenciales de Acceso</h5>
                            </div>
                            <div class="card-body text-center" >
                                
                                <p><strong>Contraseña:</strong> {{ $value->usuario }}</p>
                                <p><strong>Contraseña:</strong> {{ $value->contrasenia }}</p>
                                <p><strong>Contraseña de motor:</strong> {{ $value->contraseniaParo }}</p>
                                <p><strong>Comentarios:</strong> {{ $value->comentarios }}</p>

                                <!-- Actions: Links to Vehículos and Cuentas Espejo -->
                           
                           
                                <a href="{{ route('buscar.ctaespejo', $value->id) }}" class="btn btn-primary btn-sm">Cuenta Espejo</a>
                                <a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-primary btn-sm">Vehículos</a>
                            </div>

                            <div class="card-footer text-center">
                                @can('cuenta.edit')
                                    <a href="{{ url('/cuenta/' . $value->id . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>
                                @endcan

                                @can('cuenta.destroy')
                                    <form action="{{ url('/cuenta/' . $value->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <a href="{{ route('cliente.show', $cliente_id) }}" class="btn btn-dark">Regresar</a>
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