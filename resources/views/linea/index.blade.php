@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Datos de Linea</h3>
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
    <form class="d-flex" role="search">
        <input name="busqueda" class="form-control me-2" type="search" value="{{$busqueda}}"
            placeholder="Buscar por Sim Card/Numero de telefono / " aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    <br>
{{--     <a href="{{ url('linea/create') }}" class="btn btn-success">Registrar Nueva Linea</a>
--}}

    <br><br>

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>simcard</th>
                        <th>telefono</th>
                        <th>tipoLínea</th>
                        <th>cliente </th>
                        <th>acciones</th>

                    </tr>
                </thead>

                <tbody>


                    @if (count($lineas) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{$busqueda}} </td>
                        </tr>
                    @else
                        @foreach ($lineas as $linea)
                            <tr>

                                <td> 
                                    
                                    
                                    <a href=" {{ route('buscar.linea', $linea->dispositivo_id) }}"
                                        class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;">
                                       Ver detalles de :  {{ $linea->id }} </a>


                                </td>
                                <td>{{ $linea->simcard }}</td>
                                <td>{{ $linea->telefono }}</td>
                                <td>{{ $linea->tipolinea }}</td>
                                <td> {{ $linea->cliente->nombre }} {{ $linea->cliente->segnombre }}
                                    {{ $linea->cliente->apellidopat }} {{ $linea->cliente->apellidomat }}</td>

                                <td>
                                    <a href="{{ url('/linea/' . $linea->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>

                                    <form action="{{ url('/linea/' . $linea->id) }}" method="post" class="d-inline">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-danger" type="submit"
                                            onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <br>

    {!! $lineas->links() !!}


@endsection
