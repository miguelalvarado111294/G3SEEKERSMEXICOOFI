@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/vehiculo') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('/vehiculo.form', ['modo' => 'Crear']);
        </form>
    </div>
@endsection
