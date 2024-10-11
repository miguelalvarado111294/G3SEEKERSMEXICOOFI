@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Cuentas</h3>

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
            placeholder="Buscar por Usuario" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    {{--     <a href="{{ url('cuenta/create') }}" class="btn btn-success">Registrar nueva cuenta</a> --}}
    </br>
    <br>
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Cliente</th>
                        <th>usuario</th>
                        <th>contrasenia</th>
                        <th>contraseniaParo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($cuentas) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        @foreach ($cuentas as $cuenta)
                            <tr>
                                <td><a href="{{ route('cliente.show', $cuenta->cliente->id) }}" class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;">
                                        {{ $cuenta->cliente->nombre }}
                                        {{ $cuenta->cliente->segnombre }}
                                        {{ $cuenta->cliente->apellidopat }}
                                        {{ $cuenta->cliente->apellidomat }}
                                </td>

                                <td>{{ $cuenta->usuario }}</td>
                                <td>{{ $cuenta->contrasenia }}</td>
                                <td>{{ $cuenta->contraseniaParo }}</td>

                                <td>
                                    <a href="{{ url('/cuenta/' . $cuenta->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>
                                    -
                                    <form action="{{ url('/cuenta/' . $cuenta->id) }}" method="post" class="d-inline">
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
    {!! $cuentas->links() !!}


@endsection
