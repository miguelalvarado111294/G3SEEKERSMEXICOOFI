@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

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
