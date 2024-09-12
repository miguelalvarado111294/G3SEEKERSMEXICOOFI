@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Cuentas</h3>
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
    <a href="{{ url('cuenta/create') }}" class="btn btn-success">Registrar nueva cuenta</a>
    </br>
    <br>
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>cliente</th>
                        <th>usuario</th>
                        <th>contrasenia</th>
                        <th>vehiculo</th>
                        <th>contraseniaParo</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($cuentas as $cuenta)
                        <tr>
                            <td>{{ $cuenta->cliente->nombre }} {{ $cuenta->cliente->apellidopat }}
                                {{ $cuenta->cliente->apellidomat }}</td>
                            <td>{{ $cuenta->usuario }}</td>
                            <td>{{ $cuenta->contrasenia }}</td>
                            <td>{{ $cuenta->contraseniaParo }}</td>
                            <td>
                                <a href="{{ url('/cuenta/' . $cuenta->id . '/edit') }}" class="btn btn-warning">Editar</a>
                                -
                                <form action="{{ url('/cuenta/' . $cuenta->id) }}" method="post" class="d-inline">
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

    {!! $cuentas->links() !!}


@endsection
