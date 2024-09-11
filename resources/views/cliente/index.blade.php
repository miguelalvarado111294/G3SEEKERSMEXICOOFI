@extends('layouts.app')
@section('content')
    <div class="container">

        <h1 style="text-align: center; display: inline-block; width: 100%; ">Datos de Clientes</h1>
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"> &times </span>
                </button>
            </div>
        @endif

        <form class="d-flex" role="search">
            <input name="busqueda" class="form-control me-2" type="search"
                placeholder="Buscar por Nombre , Apellido , telefono, dispositivo n/s, cuenta " aria-label="Search">
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
                <ul>
                    @foreach ($clientes as $cliente)
                        <a href=" {{ route('cliente.show', $cliente->id) }}" class="btn btn-primary"
                            style="text-align: center; display: inline-block; width: 50%;">
                            {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }}
                            {{ $cliente->apellidomat }}
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        <br>

        <br><br>
        {!! $clientes->links() !!}

    </div>
@endsection
