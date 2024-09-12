@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
<br>
    <h3 class="text-center">Editar Sensor</h3>
<br>

        <form action="{{ url('/sensor/' . $sensors->id) }}" method="post"> >
            @csrf
            {{ method_field('PATCH') }}
            @include('/sensor.form', ['modo' => 'Editar']);
        </form>

    </div>
@endsection
