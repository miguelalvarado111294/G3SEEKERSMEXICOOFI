@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
@stop

@section('content')
    <p class="text-center">Bienvenido <b> {{ Auth::user()->name }} al Panel de Control</b></p>
<br>
<br>
<br>

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <img src="{{ asset('storage\logo.png') }}" width="600">
            </div>
        </div>
    </div>

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
