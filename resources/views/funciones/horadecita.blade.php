@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

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
    <h3 class="text-center">Ingrese los Datos Para Generar Orden de Servicio</h3>
@stop

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
        @endif

        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('crear.ordens', $vehiculo) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fechacita">Ingrese la Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" name="fechacita" id="fechacita" required>
                        @error('fechacita')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion">Ingrese la Dirección de la Cita</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" required>
                        @error('direccion')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-center">

                        <input type="submit" class="btn btn-success" value="Generar Orden de Servicio">

                    </div>

            </div>
            </form>
        </div>
    </div>
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