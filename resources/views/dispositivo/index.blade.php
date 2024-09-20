@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Dispositivos</h3>
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
            placeholder="Buscar por ID / Numero econonomico / Modelo Numero / de Serie / Imei  " aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    <br>
    {{-- <a href="{{ url('dispositivo/create') }}" class="btn btn-success">Registrar nuevo dispositivo</a> --}}
    <br><br>

    <div class="card">

        <div class="card-body">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>id</th>
                        <th>cliente</th>
                        <th>modelo</th>
                        <th>noserie</th>
                        <th>imei</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($dispositivos) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        @foreach ($dispositivos as $dispositivo)
                            <tr>
                                <td> <a href=" {{ route('buscar.dispositivo', $dispositivo->vehiculo_id) }}"
                                        class="btn btn-default"
                                        style="text-align: center; display: inline-block; width: 100%;">
                                        {{ $dispositivo->id }} </a>
                                </td>
                                <td> {{ $dispositivo->cliente->nombre }} {{ $dispositivo->cliente->segnombre }}
                                    {{ $dispositivo->cliente->apellidopat }} {{ $dispositivo->cliente->apellidomat }} </td>
                                <td>{{ $dispositivo->modelo }}</td>
                                <td>{{ $dispositivo->noserie }}</td>
                                <td>{{ $dispositivo->imei }}</td>

                                <td>
                                    <a href="{{ url('/dispositivo/' . $dispositivo->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>

                                    <form action="{{ url('/dispositivo/' . $dispositivo->id) }}" method="post"
                                        class="d-inline">
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




    {!! $dispositivos->links() !!}


@endsection
