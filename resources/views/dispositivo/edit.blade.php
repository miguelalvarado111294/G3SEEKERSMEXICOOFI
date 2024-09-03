@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ url('/dispositivo/' . $dispositivo->id) }}" method="post"> >
            @csrf
            {{ method_field('PATCH') }}
            @include('/dispositivo.form', ['modo' => 'Editar']);
        </form>

    </div>
@endsection
