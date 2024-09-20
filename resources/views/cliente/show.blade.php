@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <h3 class="text-center">Datos Personales</h3>

    <br>
    <div class="card">

        <div class="card-body">
            <ul>

               <b>Nombre :</b>  {{ $cliente->nombre }} <br>
                <b>Segundo Nombre :</b> {{ $cliente->segnombre }}<br>
               <b> Apellido Paterno :</b> {{ $cliente->apellidopat }}<br>
               <b> Apellido Materno :</b> {{ $cliente->apellidomat }} <br>
                <b>Telefono :</b> {{ $cliente->telefono }} <br>
               <b> Direccion :</b> {{ $cliente->direccion }} <br>
               <b> Email : </b>{{ $cliente->email }} <br>
               <b> RFC : </b>{{ $cliente->rfc }} <br>
               <b> Comentarios</b> {{ $cliente->comentarios }}

            </ul>

        </div>
    </div>

    @can('cliente.edit')
        <a href="{{ url('/cliente/' . $cliente->id . '/edit') }}" style="text-align: center; display: inline-block; width: 17%; "
            class="btn btn-warning">Editar</a>
    @endcan

    @can('cliente.destroy')
        <form action="{{ url('/cliente/' . $cliente->id) }}" method="post" class="d-inline">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" style="text-align: center; display: inline-block; width: 17%; " type="submit"
                onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
        </form>
    @endcan
    <br><br>

    <div class="card">
        <div class="card-body">

            <a href="{{ route('buscar.buscararchivos', $cliente->id) }}" class="btn btn-primary"
                style="text-align: center; display: inline-block; width: 17%; ">Documentos electronicos</a>
            <a href="{{ route('buscar.cuenta', $cliente->id) }} "
                style="text-align: center; display: inline-block; width: 17%;" class="btn btn-primary">Cuenta</a>
        </div>

    </div>


    <br>

    <div class="card">

        <div class="card-body">

            <h3 class="text-center">Referencias</h3>
            <br>
            <a href="{{ route('referenciaf.crear', $cliente->id) }}" class="btn btn-success">Registrar Nueva Referencia</a>
            <br>
            <br>

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
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
    <br>

    <a href="{{ url('cliente') }}" class="btn btn-dark">Regresar</a>

@endsection
