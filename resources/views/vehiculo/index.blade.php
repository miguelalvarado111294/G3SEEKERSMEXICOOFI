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
        <a href="{{ url('vehiculo/create') }}" class="btn btn-success">Registrar Vehiculos</a>
        <br><br><br>
        <h1>Vehiculos</h1>
        </br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Numero de Serie</th>
                    <th>Placa</th>
                    <th>Color</th>
                    <th>cuenta</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($vehiculos as $vehiculo)
                    <tr>
                        <td> {{ $vehiculo->id }} </td>
                        <td>{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidopat }}
                            {{ $vehiculo->cliente->apellidomat }}</td>{{-- campo para el cliente --}}
                        <td>{{ $vehiculo->marca }}</td>
                        <td>{{ $vehiculo->modelo }}</td>
                        <td>{{ $vehiculo->noserie }}</td>
                        <td>{{ $vehiculo->placa }}</td>
                        <td>{{ $vehiculo->color }}</td>


                        <td>
                            <a href="{{ url('/vehiculo/' . $vehiculo->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            -
                            <form action="{{ url('/vehiculo/' . $vehiculo->id) }}" method="post" class="d-inline">
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
        {!! $vehiculos->links() !!}


    </div>
@endsection
