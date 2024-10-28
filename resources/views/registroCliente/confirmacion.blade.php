<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        .thank-you-message {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }
        .thank-you-description {
            font-size: 18px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-danger">
                {{ session('success') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="thank-you-message">¡Gracias por tu envío!</div>
        <div class="thank-you-description">
            Hemos recibido tu información correctamente. Nos pondremos en contacto contigo pronto.
        </div>
    </div>

</body>
</html>
