{{--
<form action="{{route('cliente.index')}}" method="get">
    @csrf
    <div class="btn-group">
        <input type="text" name="busqueda" class="form-control">
        <input type="submit" value="enviar" class="btn btn-primary">
    </div>
</form>
--}}

@extends('layouts.app')
@section('content')
    <div class="container">

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
