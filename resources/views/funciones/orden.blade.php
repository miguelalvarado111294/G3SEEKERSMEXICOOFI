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

    <h1>Orden de Servicio </h1>


    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>numero de orden</th>


                    </tr>
                </thead>

                <tbody>


                    @if (count($lineas) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{$busqueda}} </td>
                        </tr>
                    @else
                        @foreach ($lineas as $linea)
                            <tr>

                                <td> 
                                    
                                    
                                    <a href=" {{ route('buscar.linea', $linea->dispositivo_id) }}"
                                        class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;">
                                       Ver detalles de :  {{ $linea->id }} </a>


                                </td>
                                <td>{{ $linea->simcard }}</td>
                                <td>{{ $linea->telefono }}</td>
                                <td>{{ $linea->tipolinea }}</td>
                                <td> {{ $linea->cliente->nombre }} {{ $linea->cliente->segnombre }}
                                    {{ $linea->cliente->apellidopat }} {{ $linea->cliente->apellidomat }}</td>

                                <td>
                                    <a href="{{ url('/linea/' . $linea->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>

                                    <form action="{{ url('/linea/' . $linea->id) }}" method="post" class="d-inline">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-danger" type="submit"
                                            onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
























    

    @foreach ($clientes as $cliente)
        {{ $cliente->nombre }} <br>

        @foreach ($cliente->vehiculos as $vehiculo)
            {{ $vehiculo->marca }}
        @endforeach
    @endforeach




    <p>Datos del Cliente</p>
    <p>Datos del Vehiculo</p>
    <p>Datos del Dispositivo</p>

    .

    <p>firma de tecnico</p>





</body>

</html>
