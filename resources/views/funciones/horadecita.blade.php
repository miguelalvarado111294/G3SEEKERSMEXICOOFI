@extends('adminlte::page')

@section('title', 'G3SEEKERS MX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Asignar Fecha y Hora</h3>
@stop

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"> &times </span>
                </button>
            </div>
        @endif
        <br>
        <div class="card">
            <div class="card-head">Agregue la fecha y Hora
                <div class="card-body">

                    <form action="{{ route('crear.ordens',$vehiculo) }}" method="get" >
                        @csrf
                        <div class="form-group">
                            <label for="fechacita">ingrese la fecha </label>
                            <input type="text" class="form-control" name="fechacita" placeholder="Dia/Mes/año" id="fechacita">
                            @error('fechacita')
                                <small style ="color: red"> {{ $message }}</small>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" class="form-control"
                                        value="Generar Orden de Servicio">
                                </div>
                            </div>
                        </div>

                    </form>





                </div>
            </div>
        </div>



    </div>
@endsection
