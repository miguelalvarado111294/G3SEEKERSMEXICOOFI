@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center" style="color: #4B8DFF; font-weight: bold;">Asignar un Rol</h1>
@stop

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <p class="h5 mb-3">Nombre del Usuario:</p>
                <p class="form-control mb-4" readonly>{{ $user->name }}</p>

                <form action="{{ route('admin.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Roles -->
                    <div class="form-group">
                        <h5 class="mb-3" style="color: #007bff;">Selecciona los roles:</h5>

                        @foreach ($roles as $role)
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}"
                                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role-{{ $role->id }}" style="font-weight: 500;">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 px-4 py-2 rounded-lg shadow-sm">Actualizar Roles</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Personalización del fondo y bordes */
        body {
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin-top: 30px;
        }

        .card {
            border-radius: 10px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
        }

        /* Estilo de los checkbox */
        .form-check-input {
            border-radius: 5px;
        }

        .form-check-label {
            font-size: 16px;
            color: #555;
            margin-left: 10px;
        }

        /* Botón personalizado */
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
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
