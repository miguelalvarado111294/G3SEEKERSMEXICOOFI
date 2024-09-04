@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
@stop

@section('content')
    <p class="text-center">lista de usuarios </b></p>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>nombre</th>
                <th>correo</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td> {{ $user->name }} </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="" class="btn btn-warning">Editar</a>

                        <form action="" method="post" class="d-inline">
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







@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
