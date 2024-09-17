@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <h3 class="text-center">Clientes</h3>
@stop














@section('css')

    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">

@endsection
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
        <br>
        <form class="d-flex" role="search">
            <input name="busqueda" class="form-control me-2" type="search" value="{{$busqueda}}"
                placeholder="Buscar por Nombre , Apellido , telefono, dispositivo n/s, cuenta"   aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar </button>
        </form>
        <br>
        @can('cliente.create')
            <div style="text-align:center; margin:auto; width: 50%;">
                <a href="{{ url('cliente/create') }}" class="btn btn-success text-align: center">Alta Nuevo Socio</a>
            </div>
        @endcan

        <br>
        <div class="card">
            <div class="card-body" style="text-align:center; margin:auto">
                @if (count($clientes) <= 0)
                    <tr>
                        <td colspan="8"> No hay resultados de . {{$busqueda}} </td>
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
        <br>
        <br>
        {!! $clientes->appends(['busqueda'=>$busqueda]) !!}

    </div>
@endsection
