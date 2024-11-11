requiero q crees dos formularios 
uno para dispositivo y otro para linea cada uno con su boton de submit 
y con el selector escoja que formulario deseo llenar 
@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Registrar un Nuevo Elemento</h3>
@stop

@section('content')
    <!-- Mostrar mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form id="registroForm" action="{{ route('store.inventario') }}" method="POST">
        @csrf

        <!-- Selección de Tipo de Registro -->
        <div class="form-group">
            <label for="tipoRegistro">Selecciona el tipo de registro:</label>
            <select name="tipoRegistro" id="tipoRegistro" class="form-control" onchange="toggleForms()">
                <option value="">Seleccione...</option>
                <option value="dispositivo">Dispositivo Nuevo</option>
                <option value="linea">Línea Telefónica</option>
            </select>
        </div>

        <!-- Formulario Dispositivo (Oculto inicialmente) -->
        <div id="dispositivoForm" class="form-group" style="display: none;">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" name="modelo" id="modelo">
            @error('modelo')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
            
            <label for="noserie">Número de Serie</label>
            <input type="text" class="form-control" name="noserie" id="noserie">
            @error('noserie')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        
            <label for="imei">IMEI</label>
            <input type="text" class="form-control" name="imei" id="imei">
            @error('imei')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        
            <label for="fechacompra">Fecha de Compra</label>
            <input type="date" class="form-control" name="fechacompra" id="fechacompra">
            @error('fechacompra')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>

            <label for="precio">Precio</label>
            <input type="text" class="form-control" name="precio" id="precio">
            @error('precio')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        
            <label for="comentarios_dispositivo">Comentarios</label>
            <input type="text" class="form-control" name="comentarios_dispositivo" id="comentarios_dispositivo">
            @error('comentarios_dispositivo')
                <small style="color: red">{{ $message }}</small>
            @enderror
        </div>

        <!-- Formulario Línea Telefónica (Oculto inicialmente) -->
        <div id="lineaForm" class="form-group" style="display: none;">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono">
            @error('telefono')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>

            <label for="tipolinea">Tipo de Línea:</label>
            <select class="form-control" name="tipolinea" id="tipolinea" required>
                <option value="">Selecciona una opción</option>
                <option value="datos">Datos</option>
                <option value="voz_y_datos">Voz y Datos</option>
            </select>
            @error('tipolinea')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>

            <label for="renovacion">Renovación:</label>
            <input type="date" class="form-control" name="renovacion" id="renovacion">
            @error('renovacion')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>

            <label for="comentarios_linea">Comentarios</label>
            <input type="text" class="form-control" name="comentarios_linea" id="comentarios_linea">
            @error('comentarios_linea')
                <small style="color: red">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botón de Envío (Oculto inicialmente) -->
        <div id="submitButton" class="form-group" style="display: none;">
            <button type="submit" class="btn btn-success">Registrar</button>
        </div>
    </form>

    <div class="form-group">
        <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
    </div>
@stop

<script>
    // Función para mostrar u ocultar formularios dependiendo de la selección
    function toggleForms() {
        const tipoRegistro = document.getElementById('tipoRegistro').value;

        // Ocultar ambos formularios inicialmente
        document.getElementById('dispositivoForm').style.display = 'none';
        document.getElementById('lineaForm').style.display = 'none';
        document.getElementById('submitButton').style.display = 'none';  // Ocultar el botón de envío

        // Mostrar el formulario correspondiente y el botón de envío
        if (tipoRegistro === 'dispositivo') {
            document.getElementById('dispositivoForm').style.display = 'block';
            document.getElementById('submitButton').style.display = 'block';
            // Limpiar los campos del otro formulario si se elige una nueva opción
            document.getElementById('lineaForm').reset();
        } else if (tipoRegistro === 'linea') {
            document.getElementById('lineaForm').style.display = 'block';
            document.getElementById('submitButton').style.display = 'block';
            // Limpiar los campos del otro formulario si se elige una nueva opción
            document.getElementById('dispositivoForm').reset();
        }
    }
</script>