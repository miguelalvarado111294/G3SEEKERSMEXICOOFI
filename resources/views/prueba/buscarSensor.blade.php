@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Datos de Sensores Instalados</h3>
    <br>

    <div class="card">
        <div class="card-body">
            <p><b>Cliente :</b> {{ $cliente->segnombre }} {{ $cliente->nombre }} {{ $cliente->segnombre }}
                {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}</p>
            <p><b>Datos del vehiculo: </b> {{ $vehiculo->marca }} Modelo : {{ $vehiculo->modelo }} Placas :
                {{ $vehiculo->placa }} color : {{ $vehiculo->color }}</p>
            <p><b>Dispositivo GPS</b></p>
            <p><b> Modelo :</b>{{ $dispositivo->modelo }} </p>
            <p> <b> Imei :</b> {{ $dispositivo->imei }} </p>
            <p> <b>noeconomico :</b> {{ $dispositivo->noeconomico }} </p>
        </div>
    </div>




    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <br>
    <br>
    @can('sensor.create')
        <a href="{{ route('sensorf.crear', $id) }}" class="btn btn-success">Registrar nuevo sensor</a>
    @endcan
    <br>
    <br>
    </br>

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Numero de Serie</th>
                        <th>Tipo</th>
                        <th>Dispositivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sensors as $sensor)
                        <tr>
                            <td>{{ $sensor->marca }} </td>
                            <td>{{ $sensor->modelo }}</td>
                            <td>{{ $sensor->noserie }}</td>
                            <td>{{ $sensor->tipo }}</td>
                            <td>{{ $sensor->comentarios }}</td>
                            <td>

                                @can('sensor.edit')
                                    <a href="{{ url('/sensor/' . $sensor->id . '/edit') }}" class="btn btn-warning">Editar</a>
                                @endcan

                                @can('sensor.destroy')
                                    <form action="{{ url('/sensor/' . $sensor->id) }}" method="post" class="d-inline">
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
    <a href=" {{ route('buscar.dispositivo', $vehiculo->id) }}" class="btn btn-dark">Regresar</a>



@endsection
