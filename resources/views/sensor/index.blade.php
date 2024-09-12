@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Sensores</h3>
    <br>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <br>
    <a href="{{ url('sensor/create') }}" class="btn btn-success">Registrar nuevo sensor</a>
    <br><br>

    <div class="card">
        <div class="card-body">


            <table class="table table-dark">
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

                            <td>
                                <a href="{{ url('/sensor/' . $sensor->id . '/edit') }}" class="btn btn-warning">Editar</a>

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


    </div>

    {!! $sensors->links() !!}


    </div>
@endsection
