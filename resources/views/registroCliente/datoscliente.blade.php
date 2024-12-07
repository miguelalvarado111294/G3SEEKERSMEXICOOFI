<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>G3 Seekers México</title>
    
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
        <h2 class="text-center">Registro Socio Nuevo</h2>

        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('create.nuevo') }}" method="get" enctype="multipart/form-data">
                    @csrf

                    @php
                        $fields = [
                            'nombre' => 'Nombre',
                            'segnombre' => 'Segundo Nombre',
                            'apellidopat' => 'Apellido Paterno',
                            'apellidomat' => 'Apellido Materno',
                            'telefono' => 'Teléfono',
                            'direccion' => 'Dirección',
                            'email' => 'Email',
                            'rfc' => 'RFC',
                        ];
                    @endphp

                    @foreach ($fields as $field => $label)
                        <div class="form-group">
                            <label for="{{ $field }}">{{ $label }}</label>
                            <input type="text" class="form-control" name="{{ $field }}"
                                   value="{{ old($field, isset($cliente) ? $cliente->$field : '') }}" id="{{ $field }}"
                                   placeholder="{{ $label }}">
                            @error($field)
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach

                    @php
                        $fileFields = [
                            'actaconstitutiva' => 'Acta Constitutiva',
                            'consFiscal' => 'Constancia de Situación Fiscal',
                            'comprDom' => 'Comprobante de Domicilio',
                            'tarjetacirculacion' => 'Tarjeta de Circulación',
                            'compPago' => 'Comprobante de Pago',
                        ];
                    @endphp

                    @foreach ($fileFields as $field => $label)
                        <div class="form-group">
                            <label for="{{ $field }}">{{ $label }}</label><br>
                            <input type="file" class="form-control" name="{{ $field }}" id="{{ $field }}" accept="image/*">
                            @error($field)
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach

                    <div class="form-group text-center">
                        <button class="btn btn-success btn-lg" type="submit">Registrar </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
