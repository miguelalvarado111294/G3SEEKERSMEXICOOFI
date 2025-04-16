@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Crear Cuenta Espejo</h3>
@endsection

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

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Formulario Cuenta Espejo</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ctaespejop.crear', $id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Usuario:</label>
                            <input type="text" class="form-control form-control-sm" name="usuario"
                                value="{{ old('usuario') }}">
                            @error('usuario')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="text" class="form-control form-control-sm" name="contrasenia"
                                value="{{ old('contrasenia') }}">
                            @error('contrasenia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Comentarios:</label>
                            <input type="text" class="form-control form-control-sm" name="comentarios"
                                value="{{ old('comentarios') }}">
                            @error('comentarios')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-success" value="Guardar Datos">
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ URL::previous() }}" class="btn btn-dark ml-2">Volver Atrás</a>

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