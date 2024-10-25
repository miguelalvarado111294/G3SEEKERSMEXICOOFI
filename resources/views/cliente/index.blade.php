@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
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

 <form class="d-flex" role="search">
            <input name="busqueda" id="busqueda" class="form-control sm me-2 " type="search" value="{{ $busqueda }}"
                placeholder="Buscar por Nombre / Apellido / Telefono / Email /  RFC" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar </button>
        </form>
        {{--
       

        <form action="">
            <div class="input-group">
                <input type="text" class="form-control" id="autocomplete">
                <div class="input-group-append">
                    <input type="text" id="autocomplete" placeholder="Buscar...">


                    <button class="btn btn-danger" type="button">Buscar</button>
                </div>
            </div>
--}}

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

    @section('js')
        <!-- Llama a jQuery desde la carpeta vendor -->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <!-- Llama a jQuery UI desde la carpeta vendor -->
        <script src="{{ asset('vendor/jqueryui/jquery-ui.min.js') }}"></script>


        <div id="miElemento" style="width: 100px; height: 100px; background-color: lightblue; text-align: center; line-height: 100px; margin: 20px;">
            Arrástrame
        </div>
        
        <script>
            $(function() {
                $("#miElemento").draggable();
            });
        </script>

    @endsection
