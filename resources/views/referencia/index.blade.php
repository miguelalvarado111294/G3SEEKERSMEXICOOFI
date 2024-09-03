@extends('layouts.app')
@section('content')
    <div class="container">

        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <br><br>
        <a href="{{ url('referencia/create') }}" class="btn btn-success">Registrar nuevo referencia</a>
        <br><br><br>
        <h1>Datos de Referencias</h1>
        </br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Cliente</th>
                    <th>Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Telefono</th>
                    <th>Parentesco</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($referencias as $referencia)
                    <tr>
                        <td>{{ $referencia->cliente->nombre }} {{ $referencia->cliente->apellidopat }}
                            {{ $referencia->cliente->apellidomat }}</td>{{-- campo para el cliente --}}
                        <td>{{ $referencia->nombre }}</td>
                        <td>{{ $referencia->segnombre }}</td>
                        <td>{{ $referencia->apellidopat }}</td>
                        <td>{{ $referencia->apellidomat }}</td>
                        <td>{{ $referencia->telefono }}</td>
                        <td>{{ $referencia->parentesco }}</td>

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

                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $referencias->links() !!}


    </div>
@endsection
