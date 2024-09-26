@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
<br>
    <h3 class="text-center">Datos Personales</h3>
<br>

        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <br><br>
        <a href="{{ route('sensorf.crear', $id) }}" class="btn btn-success">Registrar nuevo sensor</a>
        <br><br>
        <h1>Datos de sensores</h1>
        </br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Numero de Serie</th>
                    <th>Tipo</th>
                    <th>Dispositivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sensors as $sensor)
                    <tr>
                        <td>{{ $sensor->marca }} </td>
                        <td>{{ $sensor->modelo }}</td>
                        <td>{{ $sensor->noserie }}</td>
                        <td>{{ $sensor->tipo }}</td>
                        <td>{{ $sensor->comentarios }}</td>


                        <td>
                            <a href="{{ url('/sensor/' . $sensor->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            -
                            <form action="{{ url('/sensor/' . $sensor->id) }}" method="post" class="d-inline">
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


    </div>
@endsection
