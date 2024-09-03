@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/sensor') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/sensor.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
