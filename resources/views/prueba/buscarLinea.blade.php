@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h1 class="text-center">Cliente : {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }}
        {{ $cliente->apellidomat }} </h1>
    <br>
    <h3 class="text-center">Lineas</h3>
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

    @if ($numerodelineas <= 0)
     
    @can('linea.create')
    <a href="{{ route('lineaf.crear', $dispositivoid) }}" class="btn btn-success">Registrar Nueva Linea</a>
@endcan
    @endif



    <br>
    <br>
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Telefono</th>
                        <th>Simcard</th>
                        <th>TipoLínea</th>
                        <th>Fecha contratacion</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
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
        </div>
    </div>
    <br>
    <a href=" {{ route('buscar.dispositivo', $vehiculoid) }}" class="btn btn-primary">Regresar</a>
    </div>
@endsection
