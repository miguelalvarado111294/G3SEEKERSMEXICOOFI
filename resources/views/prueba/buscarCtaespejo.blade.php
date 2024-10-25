@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
    <h3 class="text-center">Cuenta Espejo</h3>

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @can('ctaespejo.create')
        <a href="{{ route('ctaesoejof.crear', $id) }}" class="btn btn-success mb-3">Registrar nueva cuenta espejo</a>
    @endcan

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ctaespejos as $ctaespejo)
                        <tr>
                            <td>{{ $ctaespejo->id }}</td>
                            <td>{{ $ctaespejo->usuario }}</td>
                            <td>{{ $ctaespejo->contrasenia }}</td>
                            <td>{{ $ctaespejo->comentarios }}</td>
                            <td>
                                @can('ctaespejo.edit')
                                    <a href="{{ route('ctaespejo.edit', $ctaespejo->id) }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('ctaespejo.destroy')
                                    <form action="{{ route('ctaespejo.destroy', $ctaespejo->id) }}" method="POST" class="d-inline">
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

    <a href="{{ route('buscar.cuenta', $cliente_id) }}" class="btn btn-dark">Regresar</a>
@endsection
