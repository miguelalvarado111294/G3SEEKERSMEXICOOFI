@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Datos Personales</h3>
<br>

        <form action="{{ url('/vehiculo') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/vehiculo.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
