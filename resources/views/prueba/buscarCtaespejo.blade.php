@extends('layouts.app')
@section('content')
    <div class="container">


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
        <h1>Cuenta Espejo de Socio</h1>

        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <td>id</td>
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
                            <a href="{{ url('/ctaespejo/' . $ctaespejo->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            -
                            <form action="{{ url('/ctaespejo/' . $ctaespejo->id) }}" method="post" class="d-inline">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit"
                                    onclick=" return confirm('seguro quieres eliminar?')" value="Borrar">
                            </form>
                        </td>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection
