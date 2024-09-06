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



            {!! Form::model($user, ['route' => ['admin.update', $user], 'method' => 'put']) !!}
            @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::close() !!}

        </div>
    </div>
    @stop
