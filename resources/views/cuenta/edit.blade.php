@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Editar Cuenta</h3>
<br>

        <form action="{{ url('/cuenta/' . $cuenta->id) }}" method="post"> 
            @csrf
            {{ method_field('PATCH') }}
            @include('/cuenta.form', ['modo' => 'Editar'])
        </form>

@endsection
