<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>G3 Seekers México - Referencia de Emergencia</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .font-weight-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center font-weight-bold">G3 Seekers México</h1>
        <h2 class="text-center">Registre una Referencia en Caso de Emergencia</h2>
        <br>

        @if (session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('create.nuevo.ref', $cliente_id) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre"
                               value="{{ isset($referencia->nombre) ? $referencia->nombre : old('nombre') }}" id="nombre">
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="segnombre">Segundo Nombre</label>
                        <input type="text" class="form-control" name="segnombre"
                               value="{{ isset($referencia->segnombre) ? $referencia->segnombre : old('segnombre') }}"
                               id="segnombre">
                        @error('segnombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellidopat">Apellido Paterno</label>
                        <input type="text" class="form-control" name="apellidopat"
                               value="{{ isset($referencia->apellidopat) ? $referencia->apellidopat : old('apellidopat') }}"
                               id="apellidopat">
                        @error('apellidopat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellidomat">Apellido Materno</label>
                        <input type="text" class="form-control" name="apellidomat"
                               value="{{ isset($referencia->apellidomat) ? $referencia->apellidomat : old('apellidomat') }}"
                               id="apellidomat">
                        @error('apellidomat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono"
                               value="{{ isset($referencia->telefono) ? $referencia->telefono : old('telefono') }}" id="telefono">
                        @error('telefono')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="parentesco">Parentesco</label>
                        <input type="text" class="form-control" name="parentesco"
                               value="{{ isset($referencia->parentesco) ? $referencia->parentesco : old('parentesco') }}"
                               id="parentesco">
                        @error('parentesco')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-success btn-lg" type="submit">Registrar </button>
                        <!-- Botón para finalizar -->
                        <a href="{{ route('confirmation') }}" class="btn btn-secondary btn-lg ml-3">Finalizar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
