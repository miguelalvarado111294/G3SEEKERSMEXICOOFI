@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
<br>
    <h3 class="text-center">Datos Personales</h3>
<br>

        <form action="{{ url('/ctaespejo') }}" method="post">
            @csrf
            @include('/ctaespejo.form', ['modo' => 'Crear']);
        </form>
@endsection
