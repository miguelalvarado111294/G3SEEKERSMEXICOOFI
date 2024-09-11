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
        @can('dispositivo.create')
            <a href="{{ route('dispositivof.crear', $id) }}" class="btn btn-warning">Asignar dispositivo</a>
        @endcan

        <br><br>
        <h1>Datos de dispositivo</h1> {{ $id }}
        </br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
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
                    <tr>
                        <td> {{ $dispositivo->id }} </td>
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
                            <a href="{{ route('buscar.linea', $dispositivo->id) }}" class="btn btn-warning">Linea</a>
                            <a href="{{ route('buscar.sensor', $dispositivo->id) }}" class="btn btn-warning">Sensor</a>
                        </td>


                    </tr>
                @endforeach
            </tbody>

        </table>
        <br><br><br>

        <a href=" {{ route('buscar.vehiculo', $cliente_id) }}" class="btn btn-primary">Regresar</a>

    </div>
@endsection
