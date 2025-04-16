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
    <h3 class="text-center">Crear Usuario y Contraseña</h3>
    <br>

    <form action="{{ route('cuentap.crear', $id) }}" method="post" class="mx-auto" style="max-width: 700px;">
        @csrf

        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control form-control-sm" name="usuario" value="{{ old('usuario') }}">
            @error('usuario')
                <small class="text-danger"> {{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="contrasenia">Contraseña:</label>
            <input type="text" class="form-control form-control-sm" name="contrasenia" value="{{ old('contrasenia') }}">
            @error('contrasenia')
                <small class="text-danger"> {{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="contraseniaParo">Contraseña de Paro:</label>
            <input type="text" class="form-control form-control-sm" name="contraseniaParo" value="{{ old('contraseniaParo') }}">
            @error('contraseniaParo')
                <small class="text-danger"> {{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="comentarios">Comentarios:</label>
            <input type="text" class="form-control form-control-sm" name="comentarios" value="{{ old('comentarios') }}">
            @error('comentarios')
                <small class="text-danger"> {{ $message }}</small>
            @enderror
        </div>

        <div class="text-center mt-4">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
        </div>
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
