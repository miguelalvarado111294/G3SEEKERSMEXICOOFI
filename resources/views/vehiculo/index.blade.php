@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Vehiculos</h3>
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
        <input name="busqueda" class="form-control me-2" type="search" value="{{ $busqueda }}"
            placeholder="Buscar por Numero de Serie, Numero de Motor o Placa " aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    <br>
    <br>
    {{--    <a href="{{ url('vehiculo/create') }}" class="btn btn-success">Registrar Vehiculos</a>
 --}}
    <br><br>

    <div class="card">
        <div class="card-body">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Numero de Serie</th>
                        <th>Placa</th>
                        <th>Color</th>
                        <th>Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($vehiculos) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        @foreach ($vehiculos as $vehiculo)
                            <tr>

                                <td> 
                                    <a href=" {{ route('buscar.dispositivo', $vehiculo->id) }}" class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;"> Ver detalles
                                </td>

                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->noserie }}</td>
                                <td>{{ $vehiculo->placa }}</td>
                                <td>{{ $vehiculo->color }}</td>
                                <td>{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidopat }}
                                    {{ $vehiculo->cliente->apellidomat }} </a>
                                </td>{{-- campo para el cliente --}}


                                <td>
                                    <a href="{{ url('/vehiculo/' . $vehiculo->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>

                                    <form action="{{ url('/vehiculo/' . $vehiculo->id) }}" method="post" class="d-inline">
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


    {!! $vehiculos->appends(['busqueda' => $busqueda]) !!}



    </div>
@endsection
