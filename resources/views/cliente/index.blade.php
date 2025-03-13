@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
@stop

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    
    <!-- Bootstrap CSS (dependencia para la estructura y componentes) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- jQuery UI CSS (opcional, si usas componentes interactivos) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @can('cliente.create')
            <div style="text-align:center; margin:auto; width: 100%;">
                <a href="{{ url('cliente/create') }}" class="btn btn-success">Alta de Nuevo Usuario  </a>
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

    <!-- Cerrar sesión -->
  

@endsection

@section('js')
    <!-- jQuery y Popper por CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    
    <!-- Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <!-- Bootstrap JS (para interactividad de componentes como botones, menús, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AdminLTE JS (funcionalidad para los elementos de AdminLTE) -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <!-- Scripts adicionales -->
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
            });
        });
    </script>
@stop
