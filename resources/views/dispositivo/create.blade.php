@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/dispositivo') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/dispositivo.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
