@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Dispositivos</h3>

    <!-- Cuadro para el contador -->
    <div class="d-flex justify-content-center mb-4">
        <div class="card text-center" style="display: inline-block; border: 2px solid #28a745; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            <div class="card-body" style="padding: 10px;">
                <h5 class="card-title" style="color: #28a745; font-size: 18px;">Total de Dispositivos</h5>
                <p class="card-text" style="font-size: 24px; font-weight: bold; color: #28a745;">
                    {{ $totalDispositivos }}
                </p>
            </div>
        </div>
    </div>

    <br>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <br>
    <form class="d-flex" role="search">
        <input name="busqueda" class="form-control me-2" type="search" value="{{ $busqueda }}"
            placeholder="Buscar por ID / Numero economico / Numero de Serie / Imei" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
    <br>

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>cliente</th>
                        <th>modelo</th>
                        <th>Numero Economico</th>
                        <th>imei</th>
                        <th>Cuenta</th>
                        <th>Sucursal</th>
                        <th>Fecha Compra</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($dispositivos) <= 0)
                        <tr>
                            <td colspan="10">No hay resultados para "{{ $busqueda }}"</td>
                        </tr>
                    @else
                        @foreach ($dispositivos as $dispositivo)
                            <tr>
                                <td>
                                    <a href="{{ route('buscar.dispositivo', $dispositivo->vehiculo_id) }}"
                                       class="btn btn-default"
                                       style="text-align: center; display: inline-block; width: 100%;">
                                        Ver detalles de: {{ $dispositivo->id }}
                                    </a>
                                </td>
                                <td>{{ $dispositivo->cliente->nombre }} {{ $dispositivo->cliente->segnombre }} {{ $dispositivo->cliente->apellidopat }} {{ $dispositivo->cliente->apellidomat }}</td>
                                <td>{{ $dispositivo->modelo }}</td>
                                <td>{{ $dispositivo->noeconomico }}</td>
                                <td>{{ $dispositivo->imei }}</td>
                                <td>{{ $dispositivo->cuenta }}</td>
                                <td>{{ $dispositivo->sucursal }}</td>
                                <td>{{ $dispositivo->fechacompra }}</td>
                                <td>{{ $dispositivo->comentarios }}</td>
                                <td>
                                    @can('dispositivo.edit')
                                    <a href="{{ url('/dispositivo/' . $dispositivo->id . '/edit') }}"
                                       class="btn btn-warning">Editar</a>
                                    @endcan

                                    @can('dispositivo.destroy')
                                    <form action="{{ url('/dispositivo/' . $dispositivo->id) }}" method="post"
                                          class="d-inline">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-danger" type="submit"
                                               onclick="return confirm('¿Seguro quieres eliminar?')" value="Borrar">
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {!! $dispositivos->links() !!}
@endsection
