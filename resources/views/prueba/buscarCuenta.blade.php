@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">
        Cuenta de Socio: {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}
    </h3>

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
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Contraseña de motor</th>
                        <th>Comentarios</th>
                        <th>Vehículos / Cuentas Espejo</th>
                        @can('cuenta.edit')
                            <th>Acciones</th>
                        @endcan
                        tito capotito planto un arbol en un clavito 
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cuenta as $value)
                        <tr>
                            <td>{{ $value->usuario }}</td>
                            <td>{{ $value->contrasenia }}</td>
                            <td>{{ $value->contraseniaParo }}</td>
                            <td>{{ $value->comentarios }}</td>
                            <td>
                                <a href="{{ route('buscar.ctaespejo', $value->id) }}" class="btn btn-primary">Cuenta Espejo</a>
                                <a href="{{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-primary">Vehículos</a>
                            </td>
                            <td>


                                @can('cuenta.edit')
                                    <a href="{{ url('/cuenta/' . $value->id . '/edit') }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('cuenta.destroy')
                                    <form action="{{ url('/cuenta/' . $value->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('cliente.show', $cliente_id) }}" class="btn btn-dark">Regresar</a>
@endsection
