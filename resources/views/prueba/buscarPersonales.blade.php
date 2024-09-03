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

        <br>
        <br>
        <h1>Documentos Adjuntos de Socios</h1>
        <br><br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>RFC</th>
                    <th>Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>{{ $clientes->rfc }}</td>
                    <td>{{ $clientes->nombre }}</td>
                    <td>{{ $clientes->segnombre }}</td>
                    <td>{{ $clientes->apellidopat }}</td>
                    <td>{{ $clientes->apellidomat }}</td>
                    <td>{{ $clientes->telefono }}</td>
                    <td>{{ $clientes->direccion }}</td>
                    <td>{{ $clientes->email }}</td>
                    <td>
                        <form action="{{ url('/prueba/' . $clientes->id) }}" method="get" class="d-inline">
                            @csrf
                            <input class="btn btn-primary" type="submit" value="Documentos">
                        </form>

                    </td>
                    <td>
                        <form action="{{ url('/prueba/' . $clientes->id . '/buscarReferencia') }}" method="get"
                            class="d-inline">
                            @csrf
                            <input class="btn btn-primary" type="submit" value="Referencias">
                        </form>



                    </td>

                </tr>


            </tbody>
        </table>
        <br>
        <br>
        <br>
        <a href="{{ url('/cliente') }}" class="btn btn-dark">Regresar</a>


    </div>
@endsection
