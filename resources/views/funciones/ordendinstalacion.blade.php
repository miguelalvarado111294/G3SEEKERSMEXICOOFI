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
    <table class="table table-bordered">
        <tr>
            <td width="140">Orden de Instalación</td>
            <td><strong>Fecha de la solicitud:</strong> {{ $horaactual }}</td>
            <td><strong>Folio:</strong> ######</td>
            <td>G3 SEEKERS Mx</td>
        </tr>
    </table>

    <table class="table table-bordered">
        <caption>Datos de Cliente</caption>
        <tr>
            <td><strong>Nombre del Cliente o Empresa:</strong> {{ $cliente->nombre }} {{ $cliente->segnombre }} {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}</td>
        </tr>
        <tr>
            <td><strong>Email:</strong> {{ $cliente->email }} <strong>Teléfono:</strong> {{ $cliente->telefono }}</td>
        </tr>
        <tr>
            <td><strong>Dirección:</strong> {{ $cliente->direccion }}</td>
        </tr>
    </table>

    <table class="table table-bordered">
        <caption>Datos de la Unidad</caption>
        <thead>
            <tr>
                <th colspan="2">Vehículo</th>
                <th colspan="2">Datos de la Línea</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Tipo de Vehículo</strong></td>
                <td>__________</td>
                <td><strong>Número</strong></td>
                <td>{{ $request->telefono }}</td>
            </tr>
            <tr>
                <td><strong>Marca</strong></td>
                <td>__________</td>
                <td><strong>Sim Card:</strong></td>
                <td>{{ $request->simcard }}</td>
            </tr>
            <tr>
                <td><strong>Modelo</strong></td>
                <td>__________</td>
                <td><strong>Modelo</strong></td>
                <td>__________</td>
            </tr>
            <tr>
                <td><strong>Número de Serie</strong></td>
                <td>__________</td>
                <td><strong>IMEI</strong></td>
                <td>__________</td>
            </tr>
            <tr>
                <td><strong>Placa</strong></td>
                <td>__________</td>
                <td><strong>ID Dispositivo</strong></td>
                <td>__________</td>
            </tr>
        </tbody>
    </table>

    <div class="text-center">
        <p>Esta orden solo podrá usarse para el servicio de un solo equipo.</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Recepción de la Unidad</th>
                    <th>Bien</th>
                    <th>Mal</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach (['Tablero', 'Vestiduras', 'Molduras', 'Toldo', 'Asiento Copiloto', 'Encendido', 'Volts'] as $item)
                    <tr>
                        <td><strong>{{ $item }}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Entrega de Unidad</th>
                    <th>Sí</th>
                    <th>No</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach (['Queda Encendido el Equipo', 'Queda Conectada la Antena GPS', 'Queda Conectada la Antena GSM', 'Encendido Manual', 'Pánico', 'Posición del Vehículo', 'Paro del Motor'] as $item)
                    <tr>
                        <td><strong>{{ $item }}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h5>Observaciones del Técnico</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="300"><strong>Observaciones</strong></th>
                    <th></th>
                    <th><strong>Bueno</strong></th>
                    <th><strong>Regular</strong></th>
                    <th><strong>Malo</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach (['Puntualidad', 'Presentación', 'Atención', 'Léxico', 'Limpieza'] as $item)
                    <tr>
                        <td></td>
                        <td><strong>{{ $item }}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table table-bordered">
            <tr>
                <td>___________________ <br> VoBo Vendedor</td>
                <td>___________________ <br> Firma del Instalador</td>
                <td>___________________ <br> Gerente de Operaciones</td>
                <td>___________________ <br> Firma de Cliente</td>
            </tr>
        </table>
    </div>
</body>

</html>
