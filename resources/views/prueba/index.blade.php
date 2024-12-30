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

        <table class="table table-light">
            <thead class="thead-light">
                <tr>

                    <th>Acta Constitutiva</th>
                    <th>Constancia de Situacion Fiscal</th>
                    <th>Comprobante Domicilio</th>
                    <th>Tarjeta Circulacion</th>
                    <th>Comprobante Pago</th>
                    <th> </th>

                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><img src="{{ asset('storage') . '/' . $clientes->actaconstitutiva }}" width="200" alt="">
                    </td>
                    <td><img src="{{ asset('storage') . '/' . $clientes->consFiscal }}" width="200" alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $clientes->comprDom }}" width="200" alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $clientes->tarjetacirculacion }}" width="200"
                            alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $clientes->compPago }}" width="200" alt=""> </td>
                    <td>

                    </td>
                </tr>


            </tbody>
        </table>

        <form action="{{ url('/prueba/' . $clientes->id . '/buscarPersonales') }}" method="get" class="d-inline">
            @csrf
            <input class="btn btn-dark" type="submit" value="Regresar">
        </form>


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