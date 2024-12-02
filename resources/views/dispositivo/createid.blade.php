@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos de AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.0.5/dist/css/adminlte.min.css">
@endsection


@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Asignar Dispositivo</h3>
@stop

@section('content')
    <!-- Formulario para seleccionar el tipo de registro -->
    <div class="form-group">
        <label for="tipoRegistro">Seleccione una opción:</label>
        <select id="tipoRegistro" class="form-control" onchange="toggleForms()">
            <option value="">Seleccione...</option>


            @can('cliente.create')
                <option value="inventario">Agregar desde Inventario</option>
            @endcan


            <option value="manual">Agregar Manualmente</option>
        </select>
    </div>

    <!-- Formulario para seleccionar un dispositivo del inventario -->
    <div id="inventarioForm" style="display: none;">
        <p id="inventarioInfo">Seleccionaste agregar desde inventario.</p>
        <div class="form-group">
            <label for="dispositivoInventario">Seleccione un dispositivo disponible:</label>
            <select id="dispositivoInventario" name="dispositivo_id" class="form-control">
                <option value="">Seleccione un dispositivo...</option>
                @foreach ($dispositivosinventario as $disp)
                    <option value="{{ $disp->id }}">
                        <b>{{ $disp->modelo }} - {{ $disp->imei }} {{ $disp->fechacompra }}</b>
                    </option>
                @endforeach
            </select>
            @error('dispositivo_id')
                <small style="color: red">{{ $message }}</small>
            @enderror
        </div>


        <!-- Botón para cargar los datos del dispositivo seleccionado -->
        <button type="button" class="btn btn-primary" id="mostrarFormulario" style="display: none;">Editar
            Dispositivo</button>
    </div>

    <!-- Formulario manual dentro de un card -->
    <div id="manualForm" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h4>Formulario para agregar dispositivo manualmente</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dispositivop.crear', $id) }}" method="post">
                    @csrf
                    <input type="hidden" name="vehiculo_id" id="vehiculo_id" value="{{ old('vehiculo_id', $id) }}">

                    <!-- Campos del formulario -->
                    <div class="form-group">
                        <label>Id en Plataforma:</label>
                        <input type="text" class="form-control" name="plataforma_id" id="plataforma_id"
                            value="{{ old('plataforma_id') }}">
                        @error('plataforma_id')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Modelo:</label>
                        <input type="text" class="form-control" name="modelo" id="modelo"
                            value="{{ old('modelo') }}">
                        @error('modelo')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Número de Serie:</label>
                        <input type="text" class="form-control" name="noserie" id="noserie"
                            value="{{ old('noserie') }}">
                        @error('noserie')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>IMEI:</label>
                        <input type="text" class="form-control" name="imei" id="imei"
                            value="{{ old('imei') }}">
                        @error('imei')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Cuenta:</label>
                        <select class="form-control" name="cuenta" id="cuenta">
                            <option value="">Seleccione una opción...</option>
                            <option value="E" {{ old('cuenta') == 'E' ? 'selected' : '' }}>E</option>
                            <option value="E2" {{ old('cuenta') == 'E2' ? 'selected' : '' }}>E2</option>
                            <option value="F" {{ old('cuenta') == 'F' ? 'selected' : '' }}>F</option>
                            <option value="G" {{ old('cuenta') == 'G' ? 'selected' : '' }}>G</option>
                            <option value="J" {{ old('cuenta') == 'J' ? 'selected' : '' }}>J</option>
                            <option value="K" {{ old('cuenta') == 'K' ? 'selected' : '' }}>K</option>
                            <option value="Tijuani" {{ old('cuenta') == 'Tijuani' ? 'selected' : '' }}>Tijuani</option>
                        </select>
                        @error('cuenta')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Sucursal:</label>
                        <select class="form-control" name="sucursal" id="sucursal">
                            <option value="">Seleccione una opción...</option>
                            <option value="Ciudad de Mexico" {{ old('sucursal') == 'Ciudad de Mexico' ? 'selected' : '' }}>
                                Ciudad de Mexico</option>
                            <option value="Pachuca de Soto" {{ old('sucursal') == 'Pachuca de Soto' ? 'selected' : '' }}>
                                Pachuca de Soto</option>
                            <option value="Ahuazoztepec" {{ old('sucursal') == 'Ahuazoztepec' ? 'selected' : '' }}>
                                Ahuazoztepec</option>
                        </select>
                        @error('sucursal')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Ubicación Dispositivo, en la Unidad:</label>
                        <input type="text" class="form-control" name="ubicaciondispositivo" id="ubicaciondispositivo"
                            value="{{ old('ubicaciondispositivo') }}">
                        @error('ubicaciondispositivo')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha Instalación:</label>
                        <input type="date" class="form-control" name="fechacompra" id="fechacompra"
                            value="{{ old('fechacompra') }}">
                        @error('fechacompra')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label>Número asignado por la Plataforma para identificar la unidad Numero Econonomico:</label>
                        <input type="text" class="form-control" name="noeconomico" id="noeconomico"
                            value="{{ old('noeconomico') }}">
                        @error('noeconomico')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Observaciones:</label>
                        <input type="text" class="form-control" name="comentarios" id="comentarios"
                            value="{{ old('comentarios') }}">
                        @error('comentarios')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Enviar Datos">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.5/dist/js/adminlte.min.js"></script>
    <!-- Script adicional para el formulario -->

    <script>
        function toggleForms() {
            const tipoRegistro = document.getElementById('tipoRegistro').value;

            const inventarioForm = document.getElementById('inventarioForm');
            const manualForm = document.getElementById('manualForm');
            const mostrarFormulario = document.getElementById('mostrarFormulario');

            // Ocultar formularios inicialmente
            inventarioForm.style.display = 'none';
            manualForm.style.display = 'none';
            mostrarFormulario.style.display = 'none'; // Ocultar el botón

            // Resetear los campos del formulario
            $('#dispositivoInventario').val('');
            $('#modelo').val('');
            $('#noserie').val('');
            $('#imei').val('');
            $('#cuenta').val('');
            $('#sucursal').val('');
            $('#ubicaciondispositivo').val('');
            $('#fechacompra').val('');
            $('#noeconomico').val('');
            $('#comentarios').val('');

            if (tipoRegistro === 'inventario') {
                inventarioForm.style.display = 'block';
            } else if (tipoRegistro === 'manual') {
                manualForm.style.display = 'block';
            }
        }


        // Detectar selección de dispositivo
        $(document).ready(function() {
            $('#dispositivoInventario').change(function() {
                var dispositivoId = $(this).val();

                // Mostrar el botón solo si se ha seleccionado un dispositivo
                if (dispositivoId) {
                    $('#mostrarFormulario').show();
                } else {
                    $('#mostrarFormulario').hide();
                }
            });

            $('#mostrarFormulario').click(function() {
                var dispositivoId = $('#dispositivoInventario').val();

                // Verificar si hay un dispositivo seleccionado
                if (dispositivoId) {
                    // Hacer una solicitud AJAX para obtener los datos del dispositivo seleccionado
                    $.ajax({
                        url: '/ruta/a/tu/controlador/' +
                            dispositivoId, // Aquí coloca la ruta correcta
                        method: 'GET',
                        success: function(data) {
                            // Ahora llenamos los valores en el formulario
                            $('#modelo').val(data.modelo);
                            $('#noserie').val(data.noserie);
                            $('#imei').val(data.imei);
                            $('#fechacompra').val(data.fechacompra);
                            $('#ubicaciondispositivo').val(data.ubicaciondispositivo);
                            $('#noeconomico').val(data.noeconomico);
                            $('#comentarios').val(data.comentarios);

                            // Mostrar el formulario de edición
                            $('#manualForm').show();
                        },
                        error: function() {
                            alert('Error al cargar los datos del dispositivo');
                        }
                    });
                } else {
                    alert('Por favor selecciona un dispositivo primero.');
                }
            });
        });
    </script>
@stop
