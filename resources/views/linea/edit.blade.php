@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ url('/linea/' . $linea->id) }}" method="post"> >
            @csrf
            {{ method_field('PATCH') }}
            @include('/linea.form', ['modo' => 'Editar']);
        </form>

    </div>
@endsection
