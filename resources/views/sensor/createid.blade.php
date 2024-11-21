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
    <h3 class="text-center">Datos Personales</h3>
    <br>

    <form action="{{ route('sensorp.crear', $id) }}" method="post">
        @csrf

        <div class="form-group">
            <label>Marca:</label>
            <input type="text" class="form-control" name="marca" value="{{ old('marca') }}">
        </div>
        <br>

        @error('marca')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Modelo : </label>
            <input type="text" class="form-control" name="modelo" value="{{ old('modelo') }}">
        </div>

        @error('modelo')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror

        <br>
        <div class="form-group">
            <label>Numero de Serie:</label>
            <input type="text" class="form-control" name="noserie" value="{{ old('noserie') }}">
        </div>
        <br>

        @error('noserie')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Tipo:</label>
            <input type="text" class="form-control" name="tipo" value="{{ old('tipo') }}">
        </div>
        <br>

        @error('tipo')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror

        <div class="form-group">
            <label>Comentarios:</label>
            <input type="text" class="form-control" name="comentarios" value="{{ old('comentarios') }}">
        </div>
        <br>

        @error('comentarios')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
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