@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><strong>G3 Seekers México</strong></h1>
@stop

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS (dependencia para la estructura y componentes) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS (opcional, si usas componentes interactivos) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection


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
