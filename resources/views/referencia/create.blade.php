@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/referencia') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/referencia.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
