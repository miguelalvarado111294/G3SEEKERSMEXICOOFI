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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">

    <style>
        .logo-image {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            height: auto;
            width: 800px; /* Define un ancho predeterminado */
        }
    </style>
@endsection

@section('content')
    <p class="text-center">Bienvenido, <strong>{{ Auth::check() ? Auth::user()->name : 'Invitado' }}</strong>, al Panel de
        Control</p>

    <!-- Imagen centrada y más grande -->
    <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="logo-image">

    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="mt-3 text-center">
            <button type="submit" class="btn btn-danger">
                {{ __('Cerrar sesión') }}
            </button>
        </div>
    </form>
    @endauth
@stop

@section('js')
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
