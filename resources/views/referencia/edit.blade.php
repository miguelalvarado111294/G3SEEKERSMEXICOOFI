@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ url('/referencia/' . $referencia->id) }}" method="post"> >
            @csrf
            {{ method_field('PATCH') }}
            @include('/referencia.form', ['modo' => 'Editar']);
        </form>

    </div>
@endsection
