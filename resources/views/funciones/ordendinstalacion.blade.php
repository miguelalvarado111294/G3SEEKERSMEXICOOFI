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
    <TABLE BORDER WIDTH="100%">
        <TR>
            <TD WIDTH="140">
                Orden Instalación
            </TD>
            <TD> <b> Fecha de Instalacion : </b>{{ $fecha_instalacion }}</TD>
            <TD><b>Folio : </b> ######</TD>
            <td>G3 SEEKERS Mx </td>
        </TR>
    </TABLE>
    {{-- formulario de obserbaciones de datos cliente --}}

    <TABLE BORDER WIDTH="100%">
        <CAPTION ALIGN=top>Datos de Cliente</CAPTION>
        <TR>
            <TD>
                <b>Nombre del Cliente o Empresa : </b> {{ $cliente->nombre }} {{ $cliente->segnombre }}
                {{ $cliente->apellidopat }} {{ $cliente->apellidomat }}
            </TD>
        </TR>
        <TR>
            <TD><b>Email : </b> {{ $cliente->email }} <b>Telefono : </b> {{ $cliente->telefono }}</TD>
        </TR>
        </TD>
        <TD> <b>Dirección de Instalacion: </b> {{$direccion_instalacion}}</TD>
        </TR>
    </TABLE>
    {{-- formulario de obserbaciones de datos uni --}}
    <TABLE BORDER WIDTH="100%">
        <CAPTION ALIGN=top>Datos de la Unidad</CAPTION>
        <TH COLSPAN=2>Vehiculo</TH>
        <TH COLSPAN=2>Datos de la Linea</TH>
        <TR>
            <TD><b> Tipo de Vehiculo </b></TD>
            <TD>{{ $vehiculo->tipo }}</TD>
            <TD> <b> Numero</b></TD>
            <TD>{{ $linea->telefono }}</TD>
        </TR>
        <TR>
            <TD> <b> Marca </b></TD>
            <TD> {{ $vehiculo->marca }}</TD>
            <TD><b> Sim Card:</b> </TD>
            <TD> {{ $linea->simcard }}</TD>
        </TR>
        <TR>
            <TD><b> Modelo </b></TD>
            <TD>{{ $vehiculo->modelo }}</TD>
            <TH COLSPAN=2>Datos del Dispositivo</TH>
        </TR>
        <TR>
            <TD><b> Numero de Serie </b></TD>
            <TD>{{ $vehiculo->noserie }} </TD>

            <TD><b> Modelo </b></TD>
            <TD>{{ $dispositivo->modelo }} </TD>
        </TR>
        <tr>
            <TD><b> Color</b></TD>
            <TD> {{ $vehiculo->color }}</TD>
            <TD><b>  Imei</b></TD>
            <TD>{{ $dispositivo->imei }} </TD>


        </tr>
        <TR>
            <TD><b> Placa </b></TD>
            <TD>{{ $vehiculo->placa }}</TD>
            <TD><b> Cuenta</b> </TD>
            <TD> {{$dispositivo->cuenta}}  </TD>
        </TR>
        <TR>
            <TD><b> </b></TD>
            <TD></TD>
            <TD><b> ID Dispositivo</b> </TD>
            <TD> {{ $dispositivo->plataforma_id }}</TD>
        </TR>
    </TABLE>

    <center>
        Esta orden solo podra usarse para el servicio de un solo equipo

        {{-- formulario de obserbaciones de observaciones --}}

        <TABLE BORDER WIDTH="100%">

            <TR>
                <TD><b>Recepcion de la Unidad</b></TD>
                <TD><b>Bien</b></TD>
                <TD><b>Mal</b></TD>
                <TD><b>Observaciones</b></TD>
            </TR>
            <TR>
                <TD><b>Tablero</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Vestiduras</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Molduras</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Toldo</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Asiento Copiloto</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Encendido</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Volts</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>

        </TABLE>

        <TABLE BORDER WIDTH="100%">

            <TR>
                <TD><b>Entrega de Unidad</b></TD>
                <TD><b>Si</b></TD>
                <TD><b>No</b></TD>
                <TD><b>Observaciones</b></TD>
            </TR>
            <TR>
                <TD><b>Queda Encendido el Equipo</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>

            <TR>
                <TD><b>Queda Conectada la Antena GPS</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Queda Conectada la Antena GSM</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Encendido Manual</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Pánico</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Posicion del Vehiculo</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD><b>Paro del Motor</b></TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>


        </TABLE>



        {{-- formulario de obserbaciones de tecnico --}}
        <TABLE BORDER WIDTH="100%">
            <TR>
                <th WIDTH="300"><b>Observaciones</b></th>
                <TH></TH>
                <TH><b>Bueno</b></TH>
                <TH><b>Regular</b></TH>
                <TH><b>Malo</b></TH>
            </TR>
            <TR>
                <TD> </TD>
                <TD><b>Puntualidad</b></TD>
                <td></td>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD> </TD>
                <TD><b>Presentacion</b></TD>
                <td></td>
                <TD> </TD>
                <TD> </TD>
            </TR>
            <TR>
                <TD> </TD>
                <TD><b>Atencion</b></TD>
                <td></td>
                <TD></TD>
                <TD> </TD>
            </TR>
            <TR>
                <TD> </TD>
                <TD><b>Lexico</b></TD>
                <td></td>
                <TD></TD>
                <TD> </TD>
            </TR>
            <TR>
                <TD></TD>
                <TD><b>Limpieza</b></TD>
                <td></td>
                <TD></TD>
                <TD> </TD>
            </TR>
        </TABLE>
        <br>
        <TABLE BORDER WIDTH="100%">
            <TR>
                <TD>
                    ___________________ <br>
                    VoBo Vendedor
                </TD>
                <TD>
                    ___________________ <br>
                    Firma del Instalador
                </TD>
                <TD>
                    ___________________ <br>
                    Gerente de Operaciones
                </TD>
                <TD>
                    ___________________ <br>
                    Firma de Cliente
                </TD>
            </TR>
        </TABLE>
</body>

</html>
