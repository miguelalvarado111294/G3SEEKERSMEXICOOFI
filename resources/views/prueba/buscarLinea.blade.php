@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
    <h1 class="text-center">Cliente: {{ "{$cliente->nombre} {$cliente->segnombre} {$cliente->apellidopat} {$cliente->apellidomat}" }}</h1>
    <h3 class="text-center">Líneas</h3>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('linea.create')
        @if ($numerodelineas <= 0)
            <a href="{{ route('lineaf.crear', $dispositivoid) }}" class="btn btn-success mb-3">Registrar Nueva Línea</a>
        @endif
    @endcan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Teléfono</th>
                        <th>Simcard</th>
                        <th>Tipo Línea</th>
                        <th>Fecha Contratación</th>
                        <th>Comentarios</th>
                        @can('linea.edit')
                            <th>Acciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineas as $linea)
                        <tr>
                            <td>{{ $linea->telefono }}</td>
                            <td>{{ $linea->simcard }}</td>
                            <td>{{ $linea->tipolinea }}</td>
                            <td>{{ $linea->renovacion }}</td>
                            <td>{{ $linea->comentarios }}</td>
                            @can('linea.edit')
                                <td>
                                    <a href="{{ route('linea.edit', $linea->id) }}" class="btn btn-warning">Editar</a>
                                </td>
                            @endcan
                            @can('linea.destroy')
                                <td>
                                    <form action="{{ route('linea.destroy', $linea->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('buscar.dispositivo', $vehiculoid) }}" class="btn btn-dark mt-3">Regresar</a>
@endsection
