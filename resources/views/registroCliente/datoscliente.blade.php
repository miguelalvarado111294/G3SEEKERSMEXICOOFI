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
        .font-weight-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center font-weight-bold">G3 Seekers México</h1>
        <h2 class="text-center">Registro Socio Nuevo</h2>

        <div class="card mt-4">
            <div class="card-body">
                <form id="form-general" action="{{ route('create.nuevo') }}" method="post"
                    enctype="multipart/form-data">
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
                            'ine' => 'Ine',
                            'compPago' => 'Comprobante de Pago', 
                            'tarjetacirculacion' => 'tarjeta de circulacion'

                        ];
                    @endphp

                    @foreach ($fileFields as $field => $label)
                        <div class="form-group">
                            <label for="{{ $field }}">{{ $label }}</label><br>
                            <input type="file" class="form-control upload-file" name="{{ $field }}" id="{{ $field }}"
                                accept="image/*,.pdf">
                            <small class="form-text text-muted">Imágenes no mayores a 3 MB.</small>
                            <small id="status-{{ $field }}" class="form-text text-muted"></small>
                            @error($field)
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach

                    <div class="form-group text-center">
                        <button class="btn btn-success btn-lg" type="submit" id="submit-form">Registrar </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            // Función para manejar la carga de cada archivo
            $('.upload-file').on('change', function () {
                let fileInput = $(this);
                let fieldName = fileInput.attr('name');
                let file = fileInput[0].files[0];
                let formData = new FormData();
                formData.append(fieldName, file);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                // Mostrar estado de carga
                $('#status-' + fieldName).text('Subiendo...');

                // Hacer la petición AJAX
                $.ajax({
                    url: "{{ route('upload.filee') }}", // Aquí se define la ruta para manejar la subida de archivos
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#status-' + fieldName).text('Subida exitosa ✔');
                    },
                    error: function (xhr) {
                        $('#status-' + fieldName).text('Error al subir el archivo ❌');
                    }
                });
            });

            // Prevenir que el formulario se envíe antes de completar las subidas
            $('#form-general').on('submit', function (e) {
                e.preventDefault();

                // Aquí puedes agregar un chequeo de que los archivos ya se hayan subido
                $(this).unbind('submit').submit(); // Si todo está listo, se envía el formulario
            });
        });
    </script>
</body>

</html>