@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Clientes</h3>
@stop

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"> &times </span>
                </button>
            </div>
        @endif
        
        <form class="d-flex" role="search">
            <input name="busqueda" class="form-control sm me-2 " type="search" value="{{ $busqueda }}"
                placeholder="Buscar por Nombre / Apellido / Telefono / Email /  RFC" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar </button>
        </form>
        <br>

        @can('cliente.create')
            <div style="text-align:center; margin:auto; width: 100%;">
                <a href="{{ url('cliente/create') }}" class="btn btn-success">Alta de Nuevo Usuario</a>
            @endcan
            <br>
            <br>
            <div class="card">
                <div class="card-body" style="text-align:center; margin:auto">
                    @if (count($clientes) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        <ul>
                            @foreach ($clientes as $cliente)
                                <a href=" {{ route('cliente.show', $cliente->id) }}" class="btn btn-default"
                                    style="text-align: center; display: inline-block; width: 100%;">
                                    {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }}
                                    {{ $cliente->apellidomat }}
                                </a>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <br>
 
            {!! $clientes->appends(['busqueda' => $busqueda]) !!}

        </div>
    @endsection
