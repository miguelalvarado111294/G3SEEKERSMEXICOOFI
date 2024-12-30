@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Asignar dispositivo</h3>
    <br>
    <br>

    <form action="{{ route('dispositivop.crear', $id) }}" method="post">
        @csrf
        <input type="hidden" id="fechacompra" name="fechacompra" value="0">
        <input type="hidden" id="precio" name="precio" value="0">
        <input type="hidden" name="tipo_asignacion" id="tipo_asignacion_hidden" value="">
        <input type="hidden" name="dispositivo_id" id="dispositivo_id" value="">

        <div class="form-group">
            <label>Tipo de Asignación:</label>
            <select name="tipo_asignacion" class="form-control" id="tipo_asignacion">
                <option value="">Seleccione </option>
                <option value="manual">Manual</option>
                <option value="inventario">Inventario</option>
            </select>
        </div>

        <div id="formulario-manual" style="display:none;">
            <div class="form-group">
                <label>Modelo:</label>
                <input type="text" class="form-control" name="modelo" id="modelo">
            </div>

            <div class="form-group">
                <label>Fecha de Instalación:</label>
                <input type="date" class="form-control" name="fechadeinstalacion">
            </div>

            <div class="form-group">
                <label>Numero de Serie:</label>
                <input type="text" class="form-control" name="noserie" id="noserie">
            </div>

            <div class="form-group">
                <label>Imei:</label>
                <input type="text" class="form-control" name="imei" id="imei">
            </div>

            <div class="form-group">
                <label>Seleccione Cuenta:</label>
                <select name="cuenta" class="form-control">
                    <option value="E">E</option>
                    <option value="E2">E2</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="J">J</option>
                    <option value="K">K</option>
                    <option value="Tijuani">Tijuani</option>
                </select>
            </div>

            <div class="form-group">
                <label>Sucursal:</label>
                <select name="sucursal" class="form-control">
                    <option value="Pachuca">Pachuca</option>
                    <option value="Oficinas_Centrales">Oficinas Centrales</option>
                    <option value="Ahuzastepec">Ahuzastepec</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ubicación Dispositivo:</label>
                <input type="text" class="form-control" name="ubicaciondispositivo">
            </div>

            <div class="form-group">
                <label>Numero Economico:</label>
                <input type="text" class="form-control" name="noeconomico">
            </div>

            <div class="form-group">
                <label>Id en Plataforma:</label>
                <input type="text" class="form-control" name="plataforma_id">
            </div>

            <div class="form-group">
                <label>Comentarios:</label>
                <input type="text" class="form-control" name="comentarios">
            </div>
        </div>

        <div id="formulario-inventario" style="display:none;">
            <div class="form-group">
                <label>Seleccionar dispositivo:</label>
                <select name="dispositivo_inventario" class="form-control" id="dispositivo_inventario">
                    @foreach ($dispositivoseninventario as $dispositivo)
                        <option value="{{ $dispositivo->id }}" data-modelo="{{ $dispositivo->modelo }}" data-noserie="{{ $dispositivo->noserie }}" data-imei="{{ $dispositivo->imei }}" data-fechacompra="{{ $dispositivo->fechacompra }}" data-precio="{{ $dispositivo->precio }}">
                            {{ $dispositivo->modelo }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Guardar </button>
    </form>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            if ($('#tipo_asignacion').val() == 'manual') {
                $('#formulario-manual').show();
            }
            if ($('#tipo_asignacion').val() == 'inventario') {
                $('#formulario-inventario').show();
            }

            $('#tipo_asignacion').change(function() {
                if ($(this).val() == 'manual') {
                    $('#formulario-manual').show();
                    $('#formulario-inventario').hide();
                    $('#tipo_asignacion_hidden').val('manual');
                } else if ($(this).val() == 'inventario') {
                    $('#formulario-manual').hide();
                    $('#formulario-inventario').show();
                    $('#tipo_asignacion_hidden').val('inventario');
                } else {
                    $('#formulario-manual').hide();
                    $('#formulario-inventario').hide();
                    $('#tipo_asignacion_hidden').val('');
                }
            });

            $('#dispositivo_inventario').change(function() {
    var dispositivo = $(this).find(':selected');
    $('#modelo').val(dispositivo.data('modelo'));
    $('#noserie').val(dispositivo.data('noserie'));
    $('#imei').val(dispositivo.data('imei'));
    $('#fechacompra').val(dispositivo.data('fechacompra'));
    $('#precio').val(dispositivo.data('precio'));
    $('#dispositivo_id').val(dispositivo.val());
    $('#formulario-inventario').hide();
    $('#formulario-manual').show();
});

        });
    </script>
@endsection
