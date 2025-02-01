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
    <h3 class="text-center">Datos Personales</h3>
<br>

        <form action="{{ url('/cliente') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/cliente.form', ['modo' => 'Crear']);
        </form>


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

    <script>
        $(document).ready(function () {
            $('.upload-file').on('change', function () {
                let fileInput = $(this);
                let file = fileInput[0].files[0];
                let fieldName = fileInput.data('field');
                let formData = new FormData();
                formData.append(fieldName, file);
                formData.append('_token', '{{ csrf_token() }}'); // CSRF Token para seguridad en Laravel

                // Mostrar estado de carga
                $('#status-' + fieldName).text('Subiendo...');

                $.ajax({
                    url: "{{ route('upload.filee') }}", // Ruta para manejar la subida en Laravel
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
        });
    </script>
@stop
