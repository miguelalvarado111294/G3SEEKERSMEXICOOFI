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
                Orden de Instalación
            </TD>
            <TD> <b> Fecha de la solicitud : </b>{{ $horaactual }}</TD>
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
        <TD> <b>Dirección : </b> {{ $cliente->direccion }}</TD>
        </TR>
    </TABLE>
    {{-- formulario de obserbaciones de datos uni --}}
    <TABLE BORDER WIDTH="100%">
        <CAPTION ALIGN=top>Datos de la Unidad</CAPTION>
        <TH COLSPAN=2>Vehiculo</TH>
        <TH COLSPAN=2>Datos de la Linea</TH>
        <TR>
            <TD><b> Tipo de Vehiculo </b></TD>
            <TD>{{-- $vehiculo->tipo --}}</TD>
            <TD> <b> Numero</b></TD>
            <TD>{{ $request->telefono }}</TD>
        </TR>
        <TR>
            <TD> <b> Marca </b></TD>
            <TD> {{-- $vehiculo->marca --}}</TD>
            <TD><b> Sim Card:</b> </TD>
            <TD> {{ $request->simcard }}</TD>
        </TR>
        <TR>
            <TD><b> Modelo </b></TD>
            <TD>{{-- $vehiculo->modelo --}}</TD>
            <TH COLSPAN=2>Datos del Dispositivo</TH>
        </TR>
        <TR>
            <TD><b> Numero de Serie </b></TD>
            <TD>{{-- $vehiculo->noseri --}} </TD>

            <TD><b> Modelo </b></TD>
            <TD>{{-- $dispositivo->model --}}</TD>
        </TR>
        <TR>
            <TD><b> Placa </b></TD>
            <TD>{{-- $vehiculo->plac --}}</TD>
            <TD><b> Imei</b> </TD>
            <TD> {{-- $dispositivo->imei --}}</TD>
        </TR>
        <TR>
            <TD><b> Color </b></TD>
            <TD>{{-- $vehiculo->color --}}</TD>
            <TD><b> ID Dispositivo</b> </TD>
            <TD> {{-- $dispositivo->id --}}</TD>
        </TR>
    </TABLE>

    <center>
        Esta orden solo podra usarse para el servicio de un solo equipo

        {{-- formulario de obserbaciones de observaciones --}}

        <TABLE BORDER WIDTH="100%">
          
            <TR>
                <TD>Recepcion de la Unidad</TD>
                <TD>Bien</TD>
                <TD>Mal</TD>
                <TD>Observaciones</TD>
            </TR>
            <TR>
                <TD>Tablero</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Vestiduras</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Molduras</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Toldo</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Asiento Copiloto</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Encendido</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Volts</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>

        </TABLE>

<br>
        <TABLE BORDER WIDTH="100%">

            <TR>
                <TD>Entrega de Unidad</TD>
                <TD>Si</TD>
                <TD>No</TD>
                <TD>Observaciones</TD>
            </TR>
            <TR>
                <TD>Queda Encendido el Equipo</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>

            <TR>
                <TD>Queda Conectada la Antena GPS</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Queda Conectada la Antena GSM</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Encendido Manual</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Pánico</TD>
                <TD></TD>
                <TD></TD>
                <TD></TD>
            </TR>
            <TR>
                <TD>Posicion del Vehiculo</TD>
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


        </TABLE>



        {{-- formulario de obserbaciones de tecnico --}}
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
