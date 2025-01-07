@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
@endsection

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Asignar Línea</h3>
    <br>

    <form action="{{ route('lineap.crear', $id) }}" method="post">
        @csrf

        <!-- Selección entre "Desde Inventario" o "Manual" -->
        <div class="form-group">
            <label>Agregar Desde:</label>
            <select class="form-control" name="origen" id="origen" required>
                <option value="">Selecciona una opción</option>
                <option value="manual">Manual</option>
                <option value="inventario">Desde Inventario</option>
            </select>
        </div>

        <!-- Campos solo visibles cuando se selecciona "Manual" -->
        <div id="manualFields" style="display: none;">
            <div class="form-group">
                <label>Sim Card:</label>
                <input type="text" class="form-control" name="simcard" value="{{ old('simcard') }}">
            </div>
            @error('simcard')
                <small style="color: red"> {{ $message }}</small>
            @enderror
            <br>

            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">
            </div>
            @error('telefono')
                <small style="color: red"> {{ $message }}</small>
            @enderror
            <br>

            <div class="form-group">
                <label for="tipolinea">Tipo de Línea:</label>
                <select class="form-control" name="tipolinea" id="tipolinea" required>
                    <option value="">Selecciona una opción</option>
                    <option value="datos">Datos</option>
                    <option value="voz_y_datos">Voz y Datos</option>
                </select>
            </div>
            @error('tipolinea')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>

            <div class="form-group">
                <label for="renovacion">Renovación:</label>
                <input type="date" class="form-control" name="renovacion" value="{{ old('renovacion') }}">
            </div>
            @error('renovacion')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>

            <div class="form-group">
                <label>Comentarios:</label>
                <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
            </div>
            @error('comentarios')
                <small style="color: red"> {{ $message }}</small>
            @enderror
            <br>


        </div>

        <!-- Campos solo visibles cuando se selecciona "Desde Inventario" -->
        <div id="inventarioFields" style="display: none;">
            <div class="form-group">
                <label for="inventario">Selecciona una línea desde el Inventario:</label>
                <select class="form-control" name="inventario" id="inventario">
                    <option value="">Selecciona una línea</option>
                    @foreach ($lineasinventario as $item)
                        <option value="{{ $item->id }}" data-simcard="{{ $item->simcard }}"
                            data-telefono="{{ $item->telefono }}" data-tipolinea="{{ $item->tipolinea }}"
                            data-renovacion="{{ $item->renovacion }}" data-comentarios="{{ $item->comentarios }}">
                            {{ $item->simcard }} - {{ $item->telefono }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br>
        </div>

        <button type="button" class="btn btn-primary" id="populateFieldsButton" style="display: none;">Rellenar
            Campos</button>
        <br><br>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
        </div>
    </form>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            function limpiarCampos() {
                $('#manualFields input, #manualFields select').val('');
            }

            $('#origen').change(function() {
                var origen = $(this).val();
                limpiarCampos();

                if (origen == 'manual') {
                    $('#manualFields').show();
                    $('#inventarioFields, #populateFieldsButton').hide();
                } else if (origen == 'inventario') {
                    $('#inventarioFields, #populateFieldsButton').show();
                    $('#manualFields').hide();
                } else {
                    $('#manualFields, #inventarioFields, #populateFieldsButton').hide();
                }
            });

            $('#populateFieldsButton').click(function() {
                var selectedOption = $('#inventario option:selected');
                $('input[name="simcard"]').val(selectedOption.data('simcard'));
                $('input[name="telefono"]').val(selectedOption.data('telefono'));
                $('select[name="tipolinea"]').val(selectedOption.data('tipolinea'));
                $('input[name="renovacion"]').val(selectedOption.data('renovacion'));
                $('input[name="comentarios"]').val(selectedOption.data('comentarios'));

                $('#manualFields').show();
                $('#inventarioFields, #populateFieldsButton').hide();
            });
        });
    </script>
@stop
