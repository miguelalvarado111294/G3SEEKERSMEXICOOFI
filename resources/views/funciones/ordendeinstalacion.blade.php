@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
    <h3 class="text-center">Ingrese datos para generar orden</h3>
@stop

@section('content')
    <form action="{{ route('ordenins') }}" method="post">
        @csrf

        <!-- Selector de Cliente -->
        <div class="form-group">
            <label>Seleccione al Cliente:</label>
            <select id="cliente" name="cliente" class="form-control">
                <option value="">--Seleccione al Cliente--</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->segnombre }}
                        {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selector de Vehículo -->
        <div class="form-group">
            <label>Seleccione el Vehículo:</label>
            <select id="vehiculo" name="vehiculo" class="form-control" disabled>
                <option value="">--Seleccione un Vehículo--</option>
            </select>
        </div>
        {{--
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
        </div>
    --}}
    </form>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cliente').change(function() {
                let clienteId = $(this).val();
                let vehiculoSelect = $('#vehiculo');

                vehiculoSelect.prop('disabled', true).html(
                    '<option value="">Cargando vehículos...</option>');

                if (clienteId) {
                    $.ajax({
                        url: `/obtener-vehiculos/${clienteId}`,
                        type: 'GET',
                        success: function(vehiculos) {
                            vehiculoSelect.prop('disabled', false).html(
                                '<option value="">--Seleccione un Vehículo--</option>');

                            vehiculos.forEach(function(vehiculo) {
                                vehiculoSelect.append(
                                    `<option value="${vehiculo.id}">${vehiculo.marca} ${vehiculo.modelo} (${vehiculo.placa})</option>`
                                );
                            });
                        },
                        error: function() {
                            vehiculoSelect.html(
                                '<option value="">No se pudieron cargar los vehículos</option>'
                                );
                        }
                    });
                } else {
                    vehiculoSelect.prop('disabled', true).html(
                        '<option value="">--Seleccione un Vehículo--</option>');
                }
            });
        });
    </script>
@stop
