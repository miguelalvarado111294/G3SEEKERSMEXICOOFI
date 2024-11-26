@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Asignar Linea</h3>
    <br>

    <form action="{{ route('lineap.crear', $id) }}" method="post">
        @csrf

        <div class="form-group">
            <label>Sim Card:</label>
            <input type="text" class="form-control" name="simcard" value="{{ old('simcard') }}">
        </div>
        @error('simcard')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>

        <br>

        <div class="form-group">
            <label>Telefono : </label>
            <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">
        </div>
        @error('telefono')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
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
        <br>
        <div class="form-group">
            <label for="renovacion">Renovación:</label>
            <input type="date" class="form-control" name="renovacion" id="renovacion" value="{{ old('renovacion') }}">
        </div>
        @error('renovacion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <br>
        
        <br>


        <div class="form-group">
            <label> Comentarios:</label>
            <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
        </div>
        @error('comentarios')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop