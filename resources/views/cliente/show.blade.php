@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>




    <h1>Datos Personales</h1>
    <div class="card">

        <div class="card-body">
            <ul>

                Nombre : {{ $cliente->nombre }} <br>
                Segundo Nombre : {{ $cliente->segnombre }}<br>
                Apellido Paterno : {{ $cliente->apellidopat }}<br>
                Apellido Materno : {{ $cliente->apellidomat }} <br>
                Telefono : {{ $cliente->telefono }} <br>
                Direccion : {{ $cliente->direccion }} <br>
                Email : {{ $cliente->email }} <br>
                RFC : {{ $cliente->rfc }} <br>
                Comentarios {{ $cliente->comentarios }}

            </ul>
            <a href="{{ route('buscar.buscararchivos', $cliente->id) }}" class="btn btn-primary"
                style="text-align: center; display: inline-block; width: 17%; ">Documentos electronicos</a>
            <a href="{{ route('buscar.cuenta', $cliente->id) }} "
                style="text-align: center; display: inline-block; width: 17%;" class="btn btn-primary">Cuenta</a>
            <br><br>
            @can('cliente.edit')
                <a href="{{ url('/cliente/' . $cliente->id . '/edit') }}"
                    style="text-align: center; display: inline-block; width: 17%; " class="btn btn-warning">Editar</a>
            @endcan

            @can('cliente.destroy')
                <form action="{{ url('/cliente/' . $cliente->id) }}" method="post" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" style="text-align: center; display: inline-block; width: 17%; " type="submit"
                        onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                </form>
            @endcan
        </div>
    </div>
    <br>
    <div class="card">

        <div class="card-body">
            <h1>Referencias </h1><a href="{{ route('referenciaf.crear', $cliente->id) }}" class="btn btn-success">Registrar
                nuevo referencia</a>
            <br>

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th># </th>
                        <th>Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Parentesco</th>
                        <th>Telefono</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($referencias as $referencia)
                        <tr>
                            <td> </td>
                            <td>{{ $referencia->nombre }}</td>
                            <td>{{ $referencia->segnombre }}</td>
                            <td>{{ $referencia->apellidopat }}</td>
                            <td>{{ $referencia->apellidomat }}</td>
                            <td>{{ $referencia->parentesco }}</td>
                            <td>{{ $referencia->telefono }}</td>
                            <td> {{ $referencia->comentarios }} </td>
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
        </div>
    </div>
    <br><br><br>

    <a href="{{ url('cliente') }}" class="btn btn-dark">Regresar</a>
@endsection
