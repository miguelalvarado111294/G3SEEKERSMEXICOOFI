@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Crear Referencias</h3>
<br>
        <form action="{{ url('/referencia') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/referencia.form', ['modo' => 'Crear'])
        </form>
    </div>
@endsection
