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
    <h3 class="text-center">Crear Descripción y Fecha</h3>
    <br>

    <form action=" {{ route('historialregister', $vehiculo_id) }} " method="post">
        @csrf

        <div class="form-group">
            <label>Descripción:</label>
            <textarea class="form-control" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
        </div>
        @error('descripcion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <br>

        <div class="form-group text-center">
            <input type="submit" class="btn btn-success" value="Guardar Datos">
        </div>
    </form>

    <div class="text-center">
        <h3>Historial del Vehículo</h3>

        <!-- Empezamos la card de Bootstrap -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Descripción y Fecha</h5>
            </div>

            <div class="card-body">
                <!-- Empezamos la tabla de Bootstrap -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Recorremos los datos del historial -->
                        @foreach ($historial as $value)
                            <tr>
                                <!-- Descripción -->
                                <td>{{ $value->descripcion }}</td>

                                <!-- Fecha -->
                                <td>{{ \Carbon\Carbon::parse($value->fecha)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación centrada -->
    <div class="text-center mt-4">
        <!-- Agregamos la clase pagination-centered o text-center para centrar los enlaces -->
        <div class="pagination justify-content-center">
            {{ $historial->links() }}
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('buscar.dispositivo', $vehiculo_id) }}" class="btn btn-dark">Regresar</a>
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