@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Ingrese los Datos Para Generar Orden de Servicio</h3>
@stop

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"> &times; </span>
                </button>
            </div>
        @endif

        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('crear.ordens', $vehiculo) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fechacita">Ingrese la Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" name="fechacita" id="fechacita" required>
                        @error('fechacita')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion">Ingrese la Dirección de la Cita</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" required>
                        @error('direccion')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-center">

                        <input type="submit" class="btn btn-success" value="Generar Orden de Servicio">

                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
