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

        <div class="form-group">
            <label>Seleccione el Vehículo:</label>
            <select id="vehiculo" name="vehiculo" class="form-control" disabled>
                <option value="">--Seleccione un Vehículo--</option>
            </select>
        </div>

       

        <div class="form-group">
            <label>Dirección de Instalación:</label>
            <input type="text" id="direccion_instalacion" name="direccion_instalacion" class="form-control">
        </div>
        <div class="form-group">
            <label>Fecha y Hora de Instalación:</label>
            <input type="datetime-local" id="fecha_instalacion" name="fecha_instalacion" class="form-control">
        </div>
        

        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="enviar" disabled>Generar Orden</button>
        </div>
    </form>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#cliente').change(function() {
            let clienteId = $(this).val();
            let vehiculoSelect = $('#vehiculo');
            $('#enviar').prop('disabled', true);

            vehiculoSelect.prop('disabled', true).html('<option value="">Cargando vehículos...</option>');
            $('#resultadoDispositivo').empty();

            if (clienteId) {
                $.ajax({
                    url: `/obtener-vehiculos/${clienteId}`,
                    type: 'GET',
                    success: function(vehiculos) {
                        vehiculoSelect.prop('disabled', false).html('<option value="">--Seleccione un Vehículo--</option>');

                        vehiculos.forEach(function(vehiculo) {
                            vehiculoSelect.append(
                                `<option value="${vehiculo.id}">${vehiculo.marca} ${vehiculo.modelo} (${vehiculo.placa})</option>`
                            );
                        });
                    },
                    error: function() {
                        vehiculoSelect.html('<option value="">No se pudieron cargar los vehículos</option>');
                    }
                });
            } else {
                vehiculoSelect.prop('disabled', true).html('<option value="">--Seleccione un Vehículo--</option>');
            }
        });

        $('#vehiculo').change(function() {
            $('#enviar').prop('disabled', !$(this).val());
        });
    });
</script>
@endsection
