@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Datos Personales</h3>

@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">

                <!-- Usar divs para los datos, en lugar de una lista con puntos -->
                <div class="row">
                    <div class="col-md-6">
                        <b>Nombre:</b> {{ $cliente->nombre }} <br>
                        <b>Segundo Nombre:</b> {{ $cliente->segnombre }}<br>
                        <b>Apellido Paterno:</b> {{ $cliente->apellidopat }}<br>
                        <b>Apellido Materno:</b> {{ $cliente->apellidomat }}<br>
                        <b>Telefono:</b> {{ $cliente->telefono }} <br>
                    </div>
                    <div class="col-md-6">
                        <b>Direccion:</b> {{ $cliente->direccion }} <br>
                        <b>Email:</b> {{ $cliente->email }} <br>
                        <b>RFC:</b> {{ $cliente->rfc }} <br>
                        <b>Comentarios:</b> {{ $cliente->comentarios }} <br>
                    </div>
                </div>
                
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('buscar.buscararchivos', $cliente->id) }}" class="btn btn-primary m-2" style="width: 17%;">Documentos electrónicos</a>
                    <a href="{{ route('buscar.cuenta', $cliente->id) }}" class="btn btn-primary m-2" style="width: 17%;">Datos Adicionales</a>
                </div>

                <br>

                @can('cliente.edit')
                    <div class="text-center">
                        <a href="{{ url('/cliente/' . $cliente->id . '/edit') }}" class="btn btn-warning m-2" style="width: 17%;">Editar</a>
                    </div>
                @endcan

                @can('cliente.destroy')
                    <div class="text-center">
                        <form action="{{ url('/cliente/' . $cliente->id) }}" method="post" class="d-inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class="btn btn-danger m-2" style="width: 17%;" type="submit" onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                        </form>
                    </div>
                @endcan
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-head">
                <h3 class="text-center">Referencias</h3>
            </div>
            <div class="card-body">
                @can('referencia.create')
                    <div class="text-center mb-3">
                        <a href="{{ route('referenciaf.crear', $cliente->id) }}" class="btn btn-success">Registrar Nueva Referencia</a>
                    </div>
                @endcan

                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Parentesco</th>
                            <th>Telefono</th>
                            <th>Comentarios</th>
                            @can('referencia.edit')
                                <th>Acciones</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($referencias as $referencia)
                            <tr>
                                <td>{{ $referencia->nombre }}</td>
                                <td>{{ $referencia->segnombre }}</td>
                                <td>{{ $referencia->apellidopat }}</td>
                                <td>{{ $referencia->apellidomat }}</td>
                                <td>{{ $referencia->parentesco }}</td>
                                <td>{{ $referencia->telefono }}</td>
                                <td>{{ $referencia->comentarios }}</td>
                                <td>
                                    @can('referencia.edit')
                                        <a href="{{ url('/referencia/' . $referencia->id . '/edit') }}" class="btn btn-warning">Editar</a>
                                    @endcan

                                    @can('referencia.destroy')
                                        <form action="{{ url('/referencia/' . $referencia->id) }}" method="post" class="d-inline">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="btn btn-danger" type="submit" onclick="return confirm('seguro quieres eliminar?')" value="Borrar">
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('cliente') }}" class="btn btn-dark">Regresar</a>
        </div>
    </div>
@endsection
