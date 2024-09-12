@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h3 class="text-center">Cuenta Espejo</h3>
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
    <a href="{{ route('ctaesoejof.crear', $id) }}" class="btn btn-success">Registrar nueva cuenta espejo</a>
    <br><br>

    <div class="card">
        <div class="card-body">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @foreach ($ctaespejos as $ctaespejo)
                    <tbody>
                        <tr>
                            <td>{{ $ctaespejo->id }}</td>
                            <td>{{ $ctaespejo->usuario }}</td>
                            <td>{{ $ctaespejo->contrasenia }}</td>
                            <td>{{ $ctaespejo->comentarios }}</td>
                            <td>
                                <a href="{{ url('/ctaespejo/' . $ctaespejo->id . '/edit') }}"
                                    class="btn btn-warning">Editar</a>
                                -
                                <form action="{{ url('/ctaespejo/' . $ctaespejo->id) }}" method="post" class="d-inline">
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


@endsection
