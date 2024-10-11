@extends('adminlte::page')
@section('title', 'G3SEEKERSMX')
@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
    <h3 class="text-center">Registre una Referencia en Caso de Emergencia</h3>
    <br>
    <div class="card">
        <div class="card-body">
            
            <form action=" {{ route('create.nuevo.ref', $cliente_id) }} " method="post">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ isset($referencia->nombre) ? $referencia->nombre : old('nombre') }}" id="nombre">
                    @error('nombre')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                    <br>
                </div>

                <div class="form-group">
                    <label for="segnombre">Segundo Nombre</label>
                    <input type="text" class="form-control" name="segnombre"
                        value="{{ isset($referencia->segnombre) ? $referencia->segnombre : old('segnombre') }}"
                        id="segnombre">
                    @error('segnombre')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                    <br>
                </div>

                <div class="form-group">
                    <label for="apellidopat">Apellido Paterno</label>
                    <input type="text" class="form-control" name="apellidopat"
                        value="{{ isset($referencia->apellidopat) ? $referencia->apellidopat : old('apellidopat') }}"
                        id="apellidopat">
                    @error('apellidopat')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                    <br>
                </div>

                <div class="form-group">
                    <label for="apellidomat">Apellido Materno</label>
                    <input type="text" class="form-control" name="apellidomat"
                        value="{{ isset($referencia->apellidomat) ? $referencia->apellidomat : old('apellidomat') }}"
                        id="apellidomat">
                    @error('apellidomat')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror

                    <br>
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" name="telefono"
                        value="{{ isset($referencia->telefono) ? $referencia->telefono : old('telefono') }}" id="telefono">
                    @error('telefono')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                    <br>
                </div>

                <div class="form-group">
                    <label for="parentesco">Parentesco</label>
                    <input type="text" class="form-control" name="parentesco"
                        value="{{ isset($referencia->parentesco) ? $referencia->parentesco : old('parentesco') }}"
                        id="parentesco">
                    @error('parentesco')
                        <small style ="color: red"> {{ $message }}</small>
                    @enderror
                    <br>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit" class="form-control">
                </div>
            @endsection

    </div>
</div>
