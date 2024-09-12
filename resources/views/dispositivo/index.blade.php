@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
<br>
    <h3 class="text-center">Datos Personales</h3>
<br>

        @if (Session::has('mensaje'))
            <div class="alert alert-success alert dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <br><br>
        <a href="{{ url('dispositivo/create') }}" class="btn btn-success">Registrar nuevo dispositivo</a>
        <br><br><br>
        <h1>Datos de dispositivo</h1>
        </br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>cliente</th>
                    <th>modelo</th>
                    <th>noserie</th>
                    <th>imei</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dispositivos as $dispositivo)
                    <tr>
                        <td>{{ $dispositivo->id }} {{ $dispositivo->cliente->apellidomat }} </td>
                        <td> {{ $dispositivo->cliente->nombre }} {{ $dispositivo->cliente->segnombre }}
                            {{ $dispositivo->cliente->apellidopat }} {{ $dispositivo->cliente->apellidomat }} </td>
                        <td>{{ $dispositivo->modelo }}</td>
                        <td>{{ $dispositivo->noserie }}</td>
                        <td>{{ $dispositivo->imei }}</td>

                        <td>
                            <a href="{{ url('/dispositivo/' . $dispositivo->id . '/edit') }}"
                                class="btn btn-warning">Editar</a>
                            -
                            <form action="{{ url('/dispositivo/' . $dispositivo->id) }}" method="post" class="d-inline">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit"
                                    onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $dispositivos->links() !!}


@endsection
