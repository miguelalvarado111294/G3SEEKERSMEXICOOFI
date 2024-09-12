@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
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



        <br><br>
        <a href="{{ url('linea/create') }}" class="btn btn-success">Registrar Nueva Linea</a>

        <br><br><br>
        <h1>Datos de Línea</h1>

        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>simcard</th>
                    <th>telefono</th>
                    <th>tipoLínea</th>
                    <th>dispositivo</th>
                    <th>cliente </th>
                    <th>acciones</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($lineas as $linea)
                    <tr>
                     
                       {{--  <td> {{ $linea->dispositivo->id }} </td> --}} 
                        <td>{{ $linea->simcard }}</td>
                        <td>{{ $linea->telefono }}</td>
                        <td>{{ $linea->tipolinea }}</td>
                        <td> {{ $linea->cliente->nombre }} </td>

                        <td>
                            <a href="{{ url('/linea/' . $linea->id . '/edit') }}" class="btn btn-warning">Editar</a>

                            <form action="{{ url('/linea/' . $linea->id) }}" method="post" class="d-inline">
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
        {!! $lineas->links() !!}


@endsection
