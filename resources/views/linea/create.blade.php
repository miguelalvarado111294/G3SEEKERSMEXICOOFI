@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/linea') }}" method="post">
            @csrf
            @include('/linea.form', ['modo' => 'Crear']);
        </form>


    </div>
@endsection
