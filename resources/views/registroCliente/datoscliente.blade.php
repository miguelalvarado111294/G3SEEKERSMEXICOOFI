@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers</b></h1>
    <br>
    <h2 class="text-center">Registro Nuevo</h2>
    <br>

    <div class="card">
        <div class="card-body">

            <form action=" {{ route('create.nuevo') }} " method="post">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ isset($cliente->nombre) ? $cliente->nombre : old('nombre') }}" id="nombre">
                    @error('nombre')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="segnombre">Segundo Nombre</label>
                    <input type="text" class="form-control" name="segnombre"
                        value="{{ isset($cliente->segnombre) ? $cliente->segnombre : old('segnombre') }}" id="segnombre">
                    @error('segnombre')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="apellidopat">Apellido Paterno</label>
                    <input type="text" class="form-control" name="apellidopat"
                        value="{{ isset($cliente->apellidopat) ? $cliente->apellidopat : old('apellidopat') }}"
                        id="apellidopat">
                    @error('apellidopat')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                    <br>
                </div>

                <div class="form-group">
                    <label for="apellidomat">Apellido Materno</label>
                    <input type="text" class="form-control" name="apellidomat"
                        value="{{ isset($cliente->apellidomat) ? $cliente->apellidomat : old('apellidomat') }}"
                        id="apellidomat">
                    @error('apellidomat')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" name="telefono"
                        value="{{ isset($cliente->telefono) ? $cliente->telefono : old('telefono') }}" id="telefono">
                    @error('telefono')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" name="direccion"
                        value="{{ isset($cliente->direccion) ? $cliente->direccion : old('direccion') }}" id="direccion"
                        placeholder="Calle /Numero /Colonia /Ciudad">
                    @error('direccion')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email"
                        value="{{ isset($cliente->email) ? $cliente->email : old('email') }}" id="email">
                    @error('email')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" name="rfc"
                        value="{{ isset($cliente->rfc) ? $cliente->rfc : old('rfc') }}" id="rfc">
                    @error('rfc')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                </div>



                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" class="form-control">
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection



{{--  <div class="row">
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="btn btn-success" type="submit" class="form-control"
                        value="{{ $modo }} datos">
                </div>
            </div>
        </div> --}}
