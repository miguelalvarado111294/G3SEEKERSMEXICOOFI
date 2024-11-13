@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center" style="color: #4B8DFF; font-weight: bold;">G3 Seekers México</h1>
@stop

@section('content')
    <div class="container py-4">
        <p class="text-center h4 mb-4">Lista de Usuarios</p>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-3 px-4 py-2 rounded-lg shadow-sm">Alta de Nuevo Usuario</a>

        {{-- Mostrar el mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow-sm rounded-lg">
            <div class="card-body">
                <table class="table table-hover table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @can('admin.index')
                                        <a href="{{ route('admin.edit', $user) }}" class="btn btn-warning rounded-lg shadow-sm">Editar</a>

                                        <form action="{{ route('admin.destroy', $user) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-lg shadow-sm"
                                                onclick="return confirm('¿Seguro quieres eliminar?')">Borrar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Personalización del fondo */
        body {
            background-color: #f9f9f9;
        }

        /* Contenedor centrado */
        .container {
            max-width: 1000px;
            margin-top: 30px;
        }

        /* Sombra en las tarjetas */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Botón Alta de Nuevo Usuario */
        .btn-success {
            background-color: #28a745;
            border-radius: 30px;
            padding: 10px 25px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Estilo de la tabla */
        .table th, .table td {
            padding: 15px;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        /* Botones de acción */
        .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Alertas */
        .alert {
            border-radius: 8px;
            padding: 15px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
