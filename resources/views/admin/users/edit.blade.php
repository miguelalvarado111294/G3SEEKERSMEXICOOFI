@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><strong>Asignar un rol</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{ $user->name }}</p>

            <form action="{{ route('admin.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}">
                        <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary mt-3">Editar Rol</button>
            </form>
        </div>
    </div>
@stop
