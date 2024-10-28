@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Referencias</h3>
    <br>


    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <br>
    <form class="d-flex" role="search">
        <input name="busqueda" class="form-control sm me-2" type="search"
            placeholder="Buscar por Nombre /Segundo Nombre/Apellido Paterno/Apellido Materno/Telefono"
            value="{{ $busqueda }}" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    <br>
    <br>
    {{--     <a href="{{ url('referencia/create') }}" class="btn btn-success">Registrar nuevo referencia</a>
--}}

    <br><br>
    <div class="card">
        <div class="card-body">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Cliente</th>
                        <th>Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Telefono</th>
                        <th>Parentesco</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($referencias) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        @foreach ($referencias as $referencia)
                            <tr>
                                <td><a href="{{ route('cliente.show', $referencia->cliente->id) }}" class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;">
                                        {{ $referencia->cliente->nombre }} {{ $referencia->cliente->apellidopat }}
                                        {{ $referencia->cliente->apellidomat }}
                                    </a>
                                </td>{{-- campo para el cliente --}}
                                <td>{{ $referencia->nombre }}</td>
                                <td>{{ $referencia->segnombre }}</td>
                                <td>{{ $referencia->apellidopat }}</td>
                                <td>{{ $referencia->apellidomat }}</td>
                                <td>{{ $referencia->telefono }}</td>
                                <td>{{ $referencia->parentesco }}</td>

                                <td> 
                                    @can('referencia.edit')
                                        <a href="{{ url('/referencia/' . $referencia->id . '/edit') }}"
                                            class="btn btn-warning">Editar</a>
                                    @endcan

                                    @can('referencia.destroy')
                                        <form action="{{ url('/referencia/' . $referencia->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="btn btn-danger" type="submit"
                                                onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
    {!! $referencias->links() !!}


    </div>
@endsection
