@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>

    <br>
    <div class="card">

        <div class="card-body">
            <h3 class="text-center">Datos Personales</h3>
            <hr>
            <ul>
                <b>Nombre :</b> {{ $cliente->nombre }} <br>
                <b>Segundo Nombre :</b> {{ $cliente->segnombre }}<br>
                <b> Apellido Paterno :</b> {{ $cliente->apellidopat }}<br>
                <b> Apellido Materno :</b> {{ $cliente->apellidomat }} <br>
                <b>Telefono :</b> {{ $cliente->telefono }} <br>
                <b> Direccion :</b> {{ $cliente->direccion }} <br>
                <b> Email : </b>{{ $cliente->email }} <br>
                <b> RFC : </b>{{ $cliente->rfc }} <br>
                <b> Comentarios</b> {{ $cliente->comentarios }} <br>
            </ul>
            <hr>
            <a href="{{ route('buscar.buscararchivos', $cliente->id) }}" class="btn btn-primary"
                style="text-align: center; display: inline-block; width: 17%; ">Documentos electronicos</a>
            <a href="{{ route('buscar.cuenta', $cliente->id) }} "
                style="text-align: center; display: inline-block; width: 17%;" class="btn btn-primary">Cuenta</a>
            <br><br>
            @can('cliente.edit')
                <a href="{{ url('/cliente/' . $cliente->id . '/edit') }}"
                    style="text-align: center; display: inline-block; width: 17%; " class="btn btn-warning">Editar</a>
            @endcan

            @can('cliente.destroy')
                <form action="{{ url('/cliente/' . $cliente->id) }}" method="post" class="d-inline">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" style="text-align: center; display: inline-block; width: 17%; " type="submit"
                        onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                </form>
            @endcan
        </div>
    </div>


    <div class="card">
        <div class="card-head">
            <h3 class="text-center">Referencias</h3>
        </div>
        <div class="card-body">
            
            @can('referencia.create')
                <a href="{{ route('referenciaf.crear', $cliente->id) }}" class="btn btn-success">Registrar Nueva Referencia</a>
            @endcan
            <hr>
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
                            <td> {{ $referencia->comentarios }} </td>
                            <td>
                                @can('referencia.edit')
                                    <a href="{{ url('/referencia/' . $referencia->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>
                                @endcan

                                @can('referencia.destroy')
                                    <form action="{{ url('/referencia/' . $referencia->id) }}" method="post" class="d-inline">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-danger" type="submit"
                                            onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                    </form>
                                @endcan
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>

    <a href="{{ url('cliente') }}" class="btn btn-dark">Regresar</a>

@endsection
