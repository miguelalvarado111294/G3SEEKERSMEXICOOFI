@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
@stop

@section('content')
    <p class="text-center">Bienvenido, <strong>{{ Auth::user()->name }}</strong>, al Panel de Control</p>

    <div class="card my-4">
        <div class="card-body">
            <div class="row justify-content-center">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" width="600">
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
