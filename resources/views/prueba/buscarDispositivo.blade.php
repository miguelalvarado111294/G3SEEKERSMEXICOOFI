@extends('adminlte::page')
@section('title', 'G3SEEKERSMX')
@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h1 class="text-center">Cliente :
        @foreach ($cliente as $client)
            {{ $client->nombre }} {{ $client->segnombre }} {{ $client->apellidopat }} {{ $client->apellidomat }}
        @endforeach
    </h1>
    <br>
    <h3 class="text-center">Dispositivos Instalado en el Vehiculo</h3>
    <br>
    @if (Session::has('mensaje'))
        <div class="alert alert-success alert dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @can('dispositivo.create')
        <a href="{{ route('dispositivof.crear', $id) }}" class="btn btn-warning">Asignar dispositivo</a>
        <a href="{{ route('crear.ordens', $vehiculoid) }}" class="btn btn-warning">Generar orden</a>
    @endcan
    <br>
    <br>
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>Cuenta</th>
                        <th>Modelo</th>
                        <th>Numero de Serie</th>
                        <th>Imei</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                        <th>Lineas y Sensores</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dispositivos as $dispositivo)
                    
                        <td>{{ $dispositivo->id }} </td>
                        <td>{{ $dispositivo->cuenta }} </td>
                        <td>{{ $dispositivo->modelo }}</td>
                        <td>{{ $dispositivo->noserie }}</td>
                        <td>{{ $dispositivo->imei }}</td>
                        <td>{{ $dispositivo->comentarios }}</td>
                        <td>
                            @can('dispositivo.edit')
                                <a href="{{ url('/dispositivo/' . $dispositivo->id . '/edit') }}"
                                    class="btn btn-warning">Editar</a>
                            @endcan
                            @can('dispositivo.destroy')
                                <form action="{{ url('/dispositivo/' . $dispositivo->id) }}" method="post" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input class="btn btn-danger" type="submit"
                                        onclick=" return confirm('Estas Seguro de Eliminar?')" value="Borrar">
                                </form>
                            @endcan
                        </td>
                        <td>
                            <a href="{{ route('buscar.linea', $dispositivo->id) }}" class="btn btn-primary">Linea</a>
                            <a href="{{ route('buscar.sensor', $dispositivo->id) }}" class="btn btn-primary">Sensor</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <h3 class="text-center">Datos del Vehiculo</h3><br>
    <div class="card">
        <div class="card-head"><br>
            <ul>
                <b>
                    Vehiculo marca : {{ $vehiculo->marca }}<br>
                    Modelo : {{ $vehiculo->modelo }}<br>
                    Numero de motor : {{ $vehiculo->nomotor }}<br>
                    Numero de serie : {{ $vehiculo->noserie }}<br>
                    Placa : {{ $vehiculo->placa }}<br>
                    Color : {{ $vehiculo->color }}<br>
                </b>
            </ul>
        </div>
    </div>
    <br>
    <a href=" {{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-dark">Regresar</a>
@endsection
