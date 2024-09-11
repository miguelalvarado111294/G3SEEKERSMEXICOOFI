@extends('layouts.app')
@section('content')
    <div class="container">

        @if (Session::has('mensaje'))
            <div class="alert alert-success alert dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <br>
        @can('cuenta.create')
            <a href="{{ route('cuentaf.crear', $id) }}" class="btn btn-success">Registrar nueva cuenta</a>
        @endcan

        <br><br>

        <h1>Cuenta de Socio </h1>

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
                @foreach ($cuentas as $cuenta)
                    <tr>
                        <td>{{ $cuenta->usuario }}</td>
                        <td>{{ $cuenta->contrasenia }}</td>
                        <td>{{ $cuenta->contraseniaParo }}</td>
                        <td>{{ $cuenta->comentarios }}</td>
                        <td>

                            @can('cuenta.edit')
                                <a href="{{ url('/cuenta/' . $cuenta->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            @endcan

                            @can('cuenta.destroy')
                                <form action="{{ url('/cuenta/' . $cuenta->id) }}" method="post" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input class="btn btn-danger" type="submit"
                                        onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                </form>
                            @endcan

                        </td>

                        <td>
                            <a href="{{ route('buscar.vehiculo', $clienteid) }}"
                                class="btn btn-primary ; float-right">Vehiculos</a>
                            <a href="{{ route('buscar.ctaespejo', $cuenta->id) }}" class="btn btn-primary">Cuenta
                                Espejo</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <a href="{{url('/prueba/' . $cuentas->$cliente_id  . '/buscarVehiculo')}}" class="btn btn-success  float-right" >Vehiculos</a>
 
--}}
        <a href=" {{ route('cliente.show', $id) }}" class="btn btn-dark">Regresar</a>

        <br><br>
    @endsection
</div>
