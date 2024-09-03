@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ url('/ctaespejosecundaria/' . $ctaespejosecundaria->id) }}" method="post"> >
            @csrf
            {{ method_field('PATCH') }}
            @include('/ctaespejosecundaria.form', ['modo' => 'Editar']);
        </form>

    </div>
@endsection
