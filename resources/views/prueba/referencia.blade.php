@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

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
