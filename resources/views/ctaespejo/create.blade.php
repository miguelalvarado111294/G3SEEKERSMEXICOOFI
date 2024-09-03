@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/ctaespejo') }}" method="post">
            @csrf
            @include('/ctaespejo.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
