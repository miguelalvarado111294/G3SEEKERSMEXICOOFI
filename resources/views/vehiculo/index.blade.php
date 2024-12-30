@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Vehiculos</h3>
    
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
            placeholder="Buscar por Numero de Serie/ Numero de Motor/ Placa/ " aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    <br>
    
    <div class="card">
        <div class="card-body">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Numero de Serie</th>
                        <th>Placa</th>
                        <th>Color</th>
                        <th>Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($vehiculos) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        @foreach ($vehiculos as $vehiculo)
                            <tr>

                                <td>
                                    <a href=" {{ route('buscar.dispositivo', $vehiculo->id) }}" class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;"> Ver detalles
                                </td>

                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->noserie }}</td>
                                <td>{{ $vehiculo->placa }}</td>
                                <td>{{ $vehiculo->color }}</td>
                                <td>{{ $vehiculo->cliente->nombre }} {{ $vehiculo->cliente->apellidopat }}
                                    {{ $vehiculo->cliente->apellidomat }} </a>
                                </td>{{-- campo para el cliente --}}


                                <td>

                                    @can('vehiculo.edit')
                                        <a href="{{ url('/vehiculo/' . $vehiculo->id . '/edit') }}"
                                            class="btn btn-warning">Editar</a>
                                    @endcan


                                    @can('vehiculo.destroy')
                                        <form action="{{ url('/vehiculo/' . $vehiculo->id) }}" method="post" class="d-inline">
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



    <div class="d-flex justify-content-center">
        {!! $vehiculos->appends(['busqueda' => $busqueda]) !!}

    </div>


    </div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop