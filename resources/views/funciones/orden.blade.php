<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Orden de Servicio</title>
</head>

<body>
    <h1>Orden de instalacion </h1>
    <div class="card">
        <div class="card-body">

             <h3>Datos de Cliente</h3>
            <p> 
                <b>Cliente</b> {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }}
                {{ $cliente->apellidomat }}
                <br>
                <b>Telefono :</b> {{ $cliente->telefono }}
                <br>
                <b>Email :</b> {{ $cliente->email }}
                <br>
                <b>Dirección :</b> {{ $cliente->direccion }}
                <br>
            </p>
            

            <h3>Datos de Vehiculo</h3>
            <p>
                <b> Marca:</b>
                <br>
                <b> Modelo:</b>
                <br>
                <b> Numero de Serie:</b>
                <br>
                <b> Placa:</b>
            </p>

            <h3>Datos del Dispositivo</h3>
            <p>
                <b> Marca:</b>
                <br>
                <b> Modelo:</b>
                <br>
                <b> Numero de Serie:</b>
                <br>
                <b> Imei:</b>
            </p>

            <h3>Datos de la Linea</h3>
            <p>
                <b> Numero:</b>
                <br>
                <b> Telefono:</b>
                <br>
                <b> Sim Card:</b>

            </p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p>__________________________________________</p>
            <p>Firma del Tecnico</p>
        </div>
    </div>

























</body>

</html>
