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


        <br><br>
        @can('linea.create')
            
        <a href="{{ route('lineaf.crear', $dispositivoid) }}" class="btn btn-success">Registrar Nueva Linea</a>

        @endcan
        <br><br><br>
        <h1>Datos de Línea</h1>

        <table class="table table-light">
            <thead class="thead-light">
                <tr>

                    <th>telefono</th>
                    <th>simcard</th>
                    <th>tipoLínea</th>
                    <th>Fecha contratacion</th>
                    <th>Comentarios</th>
                    <th>acciones</th>


                </tr>
            </thead>
            @foreach ($lineas as $linea)
                <tbody>
                    <tr>
                        <td>{{ $linea->telefono }}</td>
                        <td>{{ $linea->simcard }}</td>
                        <td>{{ $linea->tipolinea }}</td>
                        <td>{{ $linea->renovacion }} </td>
                        <td>{{ $linea->comentarios }} </td>


                        <td>
                            @can('linea.edit')
                                <a href="{{ url('/linea/' . $linea->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            @endcan

                            @can('linea.destroy')
                                <form action="{{ url('/linea/' . $linea->id) }}" method="post" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input class="btn btn-danger" type="submit"
                                        onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                </form>
                            @endcan
                        </td>


                    </tr>
            @endforeach
            </tbody>
        </table>
        <br><br>

        <a href=" {{ route('buscar.dispositivo', $vehiculoid) }}" class="btn btn-primary">Regresar</a>

    </div>
@endsection
