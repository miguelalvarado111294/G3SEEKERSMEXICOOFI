@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Documentos Electrónicos</h3>

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Acta Constitutiva</th>
                        <th>Constancia de Situación Fiscal</th>
                        <th>Comprobante Domicilio</th>
                        <th>Tarjeta Circulación</th>
                        <th>Comprobante Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @php
                            $documentos = [
                                'actaconstitutiva' => 'Acta Constitutiva',
                                'consFiscal' => 'Constancia de Situación Fiscal',
                                'comprDom' => 'Comprobante Domicilio',
                                'tarjetacirculacion' => 'Tarjeta Circulación',
                                'compPago' => 'Comprobante Pago'
                            ];
                        @endphp

                        @foreach ($documentos as $campo => $nombre)
                            <td>
                                <img src="{{ asset('storage/clientes/' . basename($cliente->$campo)) }}" width="400" alt="{{ $nombre }}">
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
    </div>
@endsection
