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
                Orden de Servicio
            </TD>
            <TD> <b> Fecha de la solicitud : </b>{{ $horaactual }}</TD>
            <TD><b>Folio : </b> ######</TD>
            <td>G3 SEEKERS Mx </td>
        </TR>
    </TABLE>

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
        <TD> <b>Dirección : </b> {{ $cliente->direccion }}</TD>
        </TR>
    </TABLE>

    <TABLE BORDER WIDTH="100%">
        <CAPTION ALIGN=top>Datos de la Unidad</CAPTION>
        <TH COLSPAN=2>Vehiculo</TH>
        <TH COLSPAN=2>Datos de la Linea</TH>
        <TR>
            <TD><b> Tipo de Vehiculo : </b></TD>
            <TD>{{ $vehiculo->tipo }}</TD>
            <TD> <b> Numero:</b></TD>
            <TD>{{ $linea->telefono }}</TD>
        </TR>
        <TR>
            <TD><b> Marca : </b></TD>
            <TD> {{ $vehiculo->marca }}</TD>
            <TD><b> Sim Card:</b> </TD>
            <TD> {{ $linea->simcard }}</TD>
        </TR>
        <TR>
            <TD><b> Modelo : </b></TD>
            <TD>{{ $vehiculo->modelo }}</TD>
            <TH COLSPAN=2>Datos del Dispositivo</TH>
        </TR>
        <TR>
            <TD><b> Numero de Serie : </b></TD>
            <TD>{{ $vehiculo->noserie }}</TD>

            <TD><b> Modelo : </b></TD>
            <TD>{{ $dispositivo->modelo }}</TD>
        </TR>
        <TR>
            <TD><b> Placa : </b></TD>
            <TD>{{ $vehiculo->placa }}</TD>
            <TD><b> Imei</b> </TD>
            <TD> {{ $dispositivo->imei }}</TD>
        </TR>
        <TR>
            <TD><b> Color : </b></TD>
            <TD>{{ $vehiculo->color }}</TD>
            <TD><b> ID Dispositivo</b> </TD>
            <TD> {{ $dispositivo->id }}</TD>
        </TR>
    </TABLE>

    <center>
        Esta orden solo podra usarse para el servicio de un solo equipo
    </center>

    <TABLE BORDER WIDTH="100%">
        <TR>
            <TD WIDTH="150"><b>Recepcion</b></TD>
            <TD WIDTH="10"><b>Bien</b></TD>
            <TD WIDTH="10"><b>Mal</b></TD>
            <TD><b>Observaciones</b></TD>
        </TR>
        <TR>
            <TD>Alimentacion</TD>
            <TD></TD>
            <TD></TD>
            <TD></TD>
        </TR>
        <TR>
            <TD>Paro del Motor</TD>
            <TD></TD>
            <TD></TD>
            <TD></TD>
        </TR>
        </TR>
        <TR>
            <TD>Encendido de Equipo</TD>
            <TD></TD>
            <TD></TD>
            <TD></TD>
        </TR>
        <TR>
            <TD>Encendido de motor</TD>
            <TD> </TD>
            <TD></TD>
            <TD></TD>
        </TR>
        </TR>
        <TR>
            <TD>Conexion AntenaGMS</TD>
            <TD> </TD>
            <TD></TD>
            <TD></TD>
        </TR>
        <TR>
            <TD>Boton de Panico</TD>
            <TD> </TD>
            <TD> </TD>
            <TD></TD>
        </TR>
        </TR>
        <TR>
            <TD>Conexion AntenaGPS</TD>
            <TD> </TD>
            <TD> </TD>
            <TD></TD>
        </TR>
    </TABLE>

    <TABLE BORDER WIDTH="100%">
        <CAPTION ALIGN=top>
            Mantenimiento
        </CAPTION>
        <TR>
            <TD> <label><input type="checkbox" /> Limpieza de sim</label><br />
                <label><input type="checkbox" /> Se programo</label><br />
                <label><input type="checkbox" /> Reemplazo de Modulo</label><br />
                <label><input type="checkbox" /> Encendido Manual</label><br />
            </TD>
            <TD> <label><input type="checkbox" /> Se cambio Antena GPS</label><br />
                <label><input type="checkbox" /> Envio de Mensaje a la Plataforma</label><br />
                <label><input type="checkbox" /> Encendido Ope. Normal</label><br />
                <label><input type="checkbox" /> Paro de Motor</label><br />
            </TD>
            <TD><label><input type="checkbox" /> Se Cambio Antena GPS</label><br />
                <label><input type="checkbox" /> Reset</label><br />
                <label><input type="checkbox" /> Ubicacion Correcta</label><br />
                <label><input type="checkbox" /> Desinstalacion-Reinstalacion</label><br />
            </TD>
            <TD> <label><input type="checkbox" /> Boton de Panico</label><br />
                <label><input type="checkbox" /> Retiro Definitivo del Equipo</label><br />
            </TD>
        </TR>
    </TABLE>

    <CENter>Observaciones del Tecnico</CENter>
    <TABLE BORDER WIDTH="100%">
        <TR>
            <th WIDTH="300"><b>Observaciones</b></th>
            <TH></TH>
            <TH>Bueno</TH>
            <TH>Regular</TH>
            <TH>Malo</TH>
        </TR>
        <TR>
            <TD> </TD>
            <TD>Puntualidad</TD>
            <td></td>
            <TD></TD>
            <TD></TD>
        </TR>
        <TR>
            <TD> </TD>
            <TD>Presentacion</TD>
            <td></td>
            <TD> </TD>
            <TD> </TD>
        </TR>
        <TR>
            <TD> </TD>
            <TD>Atencion</TD>
            <td></td>
            <TD></TD>
            <TD> </TD>
        </TR>
        <TR>
            <TD> </TD>
            <TD>Lexico</TD>
            <td></td>
            <TD></TD>
            <TD> </TD>
        </TR>
        <TR>
            <TD></TD>
            <TD>Limpieza</TD>
            <td></td>
            <TD></TD>
            <TD> </TD>
        </TR>
    </TABLE>
    <br>
    <TABLE BORDER WIDTH="100%">
        <TR>
            <TD>
                <br> ___________________ <br>
                VoBo Vendedor
            </TD>
            <TD>
                <br>___________________ <br>
                Firma del Instalador
            </TD>
            <TD>
                <br> ___________________ <br>
                Gerente de Operaciones
            </TD>
            <TD>
                <br> ___________________ <br>
                Firma de Cliente
            </TD>
        </TR>
    </TABLE>
</body>

</html>
