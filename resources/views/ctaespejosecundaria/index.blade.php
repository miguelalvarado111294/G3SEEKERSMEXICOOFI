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

        <br><br>
        <a href="{{ url('ctaespejosecundaria/create') }}" class="btn btn-success">Registrar nueva cuenta</a>
        <br><br><br>
        <h1>Datos de Cta. Secundaria</h1>
        </br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>usuario</th>
                    <th>contrasenia</th>
                    <th>cta espejo</th>
                    <th>acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ctaespejosecundarias as $ctaespejosecundaria)
                    <tr>
                        <td>{{ $ctaespejosecundaria->usuario }}</td>
                        <td>{{ $ctaespejosecundaria->contrasenia }}</td>
                        <td>{{ $ctaespejosecundaria->ctaespejo->id }} </td>

                        <td>
                            <a href="{{ url('/ctaespejosecundaria/' . $ctaespejosecundaria->id . '/edit') }}"
                                class="btn btn-warning">Editar</a>
                            -
                            <form action="{{ url('/ctaespejosecundaria/' . $ctaespejosecundaria->id) }}" method="post"
                                class="d-inline">
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
        {!! $ctaespejosecundarias->links() !!}


    </div>
@endsection
