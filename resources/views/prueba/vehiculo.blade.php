@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h1 class="text-center">Cliente: {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}</h1>
    <h1 class="text-center">Cuenta: {{ $cuenta->pluck('usuario')->implode(', ') }}</h1>
    <h3 class="text-center">Vehículo(s)</h3>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('vehiculo.create')
        <div class="text-center mb-3">
            <a href="{{ route('vehiculof.crear', $id) }}" class="btn btn-success">Registrar nuevo vehículo</a>
        </div>
    @endcan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
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
                        <th>Comentarios</th>
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
                            <td>{{ $vehiculo->comentarios }}</td>
                            <td>
                                @can('vehiculo.edit')
                                    <a href="{{ route('vehiculo.edit', $vehiculo->id) }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('vehiculo.destroy')
                                    <form action="{{ route('vehiculo.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                    </form>
                                @endcan

                                <a href="{{ route('buscar.dispositivo', $vehiculo->id) }}" class="btn btn-primary">Dispositivo</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $vehiculos->links() !!}
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('buscar.cuenta', $cliente_id) }}" class="btn btn-dark">Regresar</a>
    </div>
@endsection
