@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/cuenta') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/cuenta.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
