@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>Asignar un rol</b></h1>
@stop

@section('content')


    <div class="card">

        <div class="card-body">


            <p class="h5">Nombre:</p>
            <p class="form-control"> {{ $user->name }}</p>
            <form action="{{ route('admin.update', $user) }}">
                @foreach ($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" />
                    <label>{{ $role->name }}</label>
                @endforeach
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>

        </div>


    </div>
@stop
