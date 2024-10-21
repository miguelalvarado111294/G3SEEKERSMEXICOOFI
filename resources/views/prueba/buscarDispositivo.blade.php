@extends('adminlte::page')
@section('title', 'G3SEEKERSMX')
@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h1 class="text-center">Cliente :
        {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}
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

    {{-- condificonal para aparecer boton --}}

    @if ($numerodedispositivos <= 0)
        @can('dispositivo.create')
            <a href="{{ route('dispositivof.crear', $vehiculoid) }}" class="btn btn-warning">Asignar dispositivo</a>
        @endcan
    @endif

    <a href="{{ route('crear.ordens', $vehiculoid) }}" class="btn btn-warning">Generar orden</a>


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
                        <th>Imei</th>
                        <th>Fecha de Instalación</th>

                        <th>Comentarios</th>
                        <th>Acciones</th>
                        <th>Lineas y Sensores</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($dispositivo as $value)
                        <td>{{ $value->id }} </td>
                        <td>{{ $value->cuenta }} </td>
                        <td>{{ $value->modelo }}</td>
                        <td>{{ $value->imei }}</td>
                        <td>{{ $value->fechacompra }}</td>

                        <td>{{ $value->comentarios }}</td>
                        <td>
                            @can('dispositivo.edit')
                                <a href="{{ url('/dispositivo/' . $value->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            @endcan
                            @can('dispositivo.destroy')
                                <form action="{{ url('/dispositivo/' . $value->id) }}" method="post" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input class="btn btn-danger" type="submit"
                                        onclick=" return confirm('Estas Seguro de Eliminar?')" value="Borrar">
                                </form>
                            @endcan
                        </td>
                        <td>
                            <a href="{{ route('buscar.linea', $value->id) }}" class="btn btn-primary">Linea</a>
                            <a href="{{ route('buscar.sensor', $value->id) }}" class="btn btn-primary">Sensor</a>
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
