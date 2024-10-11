@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Editar Dispositivos</h3>
<br>

        <form action="{{ url('/dispositivo/' . $dispositivo->id) }}" method="post"> 
            @csrf
            {{ method_field('PATCH') }}
            @include('/dispositivo.form', ['modo' => 'Editar'])
        </form>

@endsection
