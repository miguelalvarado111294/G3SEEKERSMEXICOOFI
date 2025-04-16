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
    <br>
    <h1 class="text-center">Cliente:
        {{ "{$cliente->nombre} {$cliente->segnombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</h1>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible text-center" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <br>    @can('crear.cita')
        <div class="text-center">
            <a href="{{ route('crear.cita', $vehiculo) }}" class="btn btn-success">Generar Orden de Servicio</a>
        </div>
    @endcan
    <br>

    @can('dispositivo.create')
        @if ($numerodedispositivos <= 0)
            <div class="text-center">
                <a href="{{ route('dispositivof.crear', $vehiculoid) }}" class="btn btn-primary">Vincular un GPS</a>
            </div>
        @endif
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
                        <p><strong>Fecha de Instalación:</strong> {{ $value->fechadeinstalacion }}</p>
                        <p><strong>Fecha de Fecha Compra:</strong> {{ $value->fechacompra }}</p>

                        <p><strong>Ubicacion Dispositivo:</strong> {{ $value->ubicaciondispositivo }}</p>
                        <p><strong>Sucursal:</strong> {{ $value->sucursal }}</p>
                        <p>
                            <strong>Comprobante de pago: </strong>  <br>
                            @if ($value->compPago)
                                <a href="{{ asset('storage/' . $value->compPago) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $value->compPago) }}" width="100" alt="Recibo de pago" class="img-fluid">
                                </a>
                            @else
                                <span class="text-muted">No disponible</span>
                            @endif
                        </p>
                        <p><strong>Observaciones:</strong> {{ $value->comentarios }}</p>
                        <br>
                        <div class ="text-center">
                            <a href="{{ route('buscar.linea', $value->id) }}" class="btn btn-primary btn-sm">Ver la Linea</a>
                            <a href="{{ route('buscar.sensor', $value->id) }}" class="btn btn-primary btn-sm">Ver el Sensor</a>
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
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar?')">Borrar</button>
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


                        

                        <li><b>Tarjeta de Circulacion:</b> {{ $vehiculo->tarjetadecirculacion }}</li>

                    </ul>
                </div>
                <div class="text-center mb-4">
                    <!-- Botón Historial -->
                    <a href="{{ route('historial', $vehiculo->id) }}" class="btn btn-info">Historial</a>
                </div>
            </div>

        </div>
    </div>
    <br>
    <div class="text-center">
        <a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-dark">Regresar</a>
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
