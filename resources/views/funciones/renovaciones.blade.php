@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Renovaciones</h3>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Formulario para seleccionar el mes -->
    <form method="GET" class="d-flex justify-content-center mb-4">
        <label for="mes" class="form-label me-2" style="line-height: 2.5;">Para buscar las renovaciones selecciona el mes: </label>
        <select name="mes" id="mes" class="form-control w-25" onchange="this.form.submit()">
            <option value="">Selecciona un mes</option>
            @foreach (range(1, 12) as $month)
                <option value="{{ $month }}" {{ request('mes') == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($month)->locale('es')->format('F') }}
                </option>
            @endforeach
        </select>
    </form>
@endsection

@section('content')

@endsection
