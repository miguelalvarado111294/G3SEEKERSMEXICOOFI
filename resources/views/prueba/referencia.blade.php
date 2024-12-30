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
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
    <h3 class="text-center">Datos Personales</h3>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ url('referencia/create') }}" class="btn btn-success mb-3">Registrar nueva referencia</a>

    <h1>Referencias de Socio</h1>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Titular</th>
                <th>Nombre</th>
                <th>Segundo Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Parentesco</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($referencias as $referencia)
                <tr>
                    <td>{{ $referencia->cliente_id }}</td>
                    <td>{{ $referencia->nombre }}</td>
                    <td>{{ $referencia->segnombre }}</td>
                    <td>{{ $referencia->apellidopat }}</td>
                    <td>{{ $referencia->apellidomat }}</td>
                    <td>{{ $referencia->parentesco }}</td>
                    <td>{{ $referencia->telefono }}</td>
                    <td>
                        <a href="{{ route('referencia.edit', $referencia->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('referencia.destroy', $referencia->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    {{-- Regresar Formulario (Descomentado si es necesario)
    <form action="{{ url('/prueba/' . $referencia->cliente_id . '/buscarPersonales') }}" method="get" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-dark">Regresar</button>
    </form> 
    --}}
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