@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Editar Cuenta Espejo</h3>
<br>

<form action="{{ url('/ctaespejo/' . $ctaespejo->id) }}" method="POST"> 
    @csrf
    @method('PUT')
    @include('/ctaespejo.form', ['modo' => 'Editar'])
</form>

@endsection


