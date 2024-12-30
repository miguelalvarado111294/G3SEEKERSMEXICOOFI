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
<br>
    <h3 class="text-center">Datos Personales</h3>
<br>

        @if (Session::has('mensaje'))
            <div class="alert alert-success alert dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <br>

        <br>
        <br>
        <h1>Documentos Adjuntos de Socios</h1>
        <br><br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>RFC</th>
                    <th>Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>{{ $clientes->rfc }}</td>
                    <td>{{ $clientes->nombre }}</td>
                    <td>{{ $clientes->segnombre }}</td>
                    <td>{{ $clientes->apellidopat }}</td>
                    <td>{{ $clientes->apellidomat }}</td>
                    <td>{{ $clientes->telefono }}</td>
                    <td>{{ $clientes->direccion }}</td>
                    <td>{{ $clientes->email }}</td>
                    <td>
                        <form action="{{ url('/prueba/' . $clientes->id) }}" method="get" class="d-inline">
                            @csrf
                            <input class="btn btn-primary" type="submit" value="Documentos">
                        </form>

                    </td>
                    <td>
                        <form action="{{ url('/prueba/' . $clientes->id . '/buscarReferencia') }}" method="get"
                            class="d-inline">
                            @csrf
                            <input class="btn btn-primary" type="submit" value="Referencias">
                        </form>



                    </td>

                </tr>


            </tbody>
        </table>
        <br>
        <br>
        <br>
        <a href="{{ url('/cliente') }}" class="btn btn-dark">Regresar</a>


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