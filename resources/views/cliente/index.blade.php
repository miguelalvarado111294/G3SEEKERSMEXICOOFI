@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>

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

        @can('cliente.create')
            <div style="text-align:center; margin:auto; width: 100%;">
                <a href="{{ url('cliente/create') }}" class="btn btn-success">Alta de Nuevo Usuario</a>
            </div>
        @endcan

        <br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <input type="text" name="search" id="search"
                        placeholder="Para Buscar un Cliente, Ingrese Nombre / Apellido / Teléfono / Email / RFC"
                        class="form-control" onfocus="this.value=''">
        
                    <div id="search_list"></div>
                </div>
            </div>
        </div>
        
        <style>
            /* Centrar el texto del placeholder */
            #search::placeholder {
                text-align: center;
            }
        
            /* Opcional: puedes personalizar también el estilo del input */
            #search {
                text-align: center; /* Centrar el texto ingresado */
            }
        </style>
        

        <br>
        <div class="card">
            <div class="card-body" style="text-align:center; margin:auto">
                @if (count($clientes) <= 0)
                    <tr>
                        <td colspan="8"> No hay resultados de {{ $busqueda }} </td>
                    </tr>
                @else
                    <ul>
                        @foreach ($clientes as $cliente)
                            <!-- Mostrar alerta solo si el perfil está incompleto -->
                            @if ($cliente->profile_incomplete)
                                <div class="alert alert-warning" role="alert">
                                    <strong>Advertencia:</strong> El perfil de {{ $cliente->nombre }} {{ $cliente->apellidopat }} está incompleto. Falta completar su cuenta.
                                </div>
                            @endif
                            <a href="{{ route('cliente.show', $cliente->id) }}" class="btn {{ $cliente->has_account ? 'btn-default' : 'btn-primary' }}"
                                style="text-align: center; display: inline-block; width: 100%;">
                                {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }}
                                {{ $cliente->apellidomat }}
                            </a>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Añadido para centrar el paginador -->
    <div class="d-flex justify-content-center">
        {!! $clientes->appends(['busqueda' => $busqueda]) !!}
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val();

                if (query.length === 0) {
                    // Limpiar la lista si el input está vacío
                    $('#search_list').html('');
                } else {

                    $.ajax({
                        url: "search",
                        type: "GET",
                        data: {
                            'search': query
                        },
                        success: function(data) {
                            $('#search_list').html(data);
                        }
                    });
                }

                //end of ajax call
            });
        });
    </script>
@stop
