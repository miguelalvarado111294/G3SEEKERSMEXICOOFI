@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Datos Personales</h3>
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


        <br>
        <br>
        <a href="{{ url('referencia/create') }}" class="btn btn-success">Registrar nuevo referencia</a>
        <br>
        <br><br>
        <h1>Referencias de Socio</h1>

        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Titular</th>
                    <th>Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Paterno</th>
                    <th>Parentesco</th>
                    <th>Telefono</th>
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
                            <a href="{{ url('/referencia/' . $referencia->id . '/edit') }}"
                                class="btn btn-warning">Editar</a>
                            -
                            <form action="{{ url('/referencia/' . $referencia->id) }}" method="post" class="d-inline">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit"
                                    onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                            </form>

                        </td>
                @endforeach
            </tbody>
        </table>


        <br><br>
        {{--
<form action="{{url('/prueba/' .  $referencia->cliente_id . '/buscarPersonales') }}" method="get" class="d-inline">
    @csrf
    <input class="btn btn-dark" type="submit" value="Regresar" >
</form>  --}}
    </div>
@endsection
