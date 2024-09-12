@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
<br>
    <h3 class="text-center">Datos Personales</h3>
<br>

        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Acta Constitutiva</th>
                    <th>Constancia de Situacion Fiscal</th>
                    <th>Comprobante Domicilio</th>
                    <th>Tarjeta Circulacion</th>
                    <th>Comprobante Pago</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><img src="{{ asset('storage') . '/' . $cliente->actaconstitutiva }}" width="200" alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $cliente->consFiscal }}" width="200" alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $cliente->comprDom }}" width="200" alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $cliente->tarjetacirculacion }}" width="200"alt=""> </td>
                    <td><img src="{{ asset('storage') . '/' . $cliente->compPago }}" width="200" alt=""> </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>




        <div class="form-group">
            <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
        </div>
        <br>


    </div>
@endsection
