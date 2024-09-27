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
    <form class="d-flex" role="search">
        <input name="busqueda" class="form-control me-2" type="search" value="{{ $busqueda }}"
            placeholder="Buscar por Numero de Serie" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar </button>
    </form>
    <br>
    <br>
    {{--     <a href="{{ url('sensor/create') }}" class="btn btn-success">Registrar nuevo sensor</a>
--}}
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
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($sensors) <= 0)
                        <tr>
                            <td colspan="8"> No hay resultados de . {{ $busqueda }} </td>
                        </tr>
                    @else
                        @foreach ($sensors as $sensor)
                            <tr>
                                <td>{{ $sensor->marca }} </td>
                                <td>{{ $sensor->modelo }}</td>
                                <td>{{ $sensor->noserie }}</td>
                                <td>{{ $sensor->tipo }}</td>


                                <td>
                                    <a href="{{ url('/sensor/' . $sensor->id . '/edit') }}"
                                        class="btn btn-warning">Editar</a>

                                    <form action="{{ url('/sensor/' . $sensor->id) }}" method="post" class="d-inline">
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

    {!! $sensors->links() !!}


    </div>
@endsection
