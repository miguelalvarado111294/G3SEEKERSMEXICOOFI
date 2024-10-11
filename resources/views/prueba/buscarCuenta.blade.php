@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Cuenta de Socio : {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }}
        {{ $cliente->apellidomat }} </h3>
    <br>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <br>

    @if ($numerodecuentas <= 0)
        @can('cuenta.create')
            <a href="{{ route('cuentaf.crear', $cliente_id) }}" class="btn btn-success">Registrar nueva cuenta</a>
        @endcan
    @endif
    <br>
    <br>

    <div class="card">
        <div class="card-body">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Contraseña de motor</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                        <th>Vehiculos / Cuentas Espejo</th>
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
                                @can('cuenta.edit')
                                    <a href="{{ url('/cuenta/' . $value->id . '/edit') }}" class="btn btn-warning">Editar</a>
                                @endcan
                                @can('cuenta.destroy')
                                    <form action="{{ url('/cuenta/' . $value->id) }}" method="post" class="d-inline">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-danger" type="submit"
                                            onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                    </form>
                                @endcan
                            </td>
                            <td>
                                <a href="{{ route('buscar.ctaespejo', $value->id) }}" class="btn btn-primary">Cuenta
                                    Espejo</a>
                                <a href="{{ route('buscar.vehiculo', $cliente_id) }}"
                                    class="btn btn-primary ; float-right">Vehiculos</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href=" {{ route('crear.nuevo.vehiculo', $cliente_id) }}" class="btn btn-dark">Regresar</a>
    <br>
    <br>
@endsection
</div>
