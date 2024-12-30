@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Documentos Electrónicos</h3>

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
                            'compPago' => 'Comprobante Pago',
                        ];
                    @endphp

                    @foreach ($documentos as $campo => $nombre)
                        <td>
                            <a href="{{ asset('storage/clientes/' . basename($cliente->$campo)) }}" target="_blank">
                                <img src="{{ asset('storage/clientes/' . basename($cliente->$campo)) }}" width="100"
                                    alt="{{ $nombre }}" class="img-fluid">
                            </a>
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


@section('js')
<!-- jQuery y Popper por CDN -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- Popper.js (necesario para Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>

<!-- Bootstrap JS (para interactividad de componentes como botones, menús, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS (funcionalidad para los elementos de AdminLTE) -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@stop
