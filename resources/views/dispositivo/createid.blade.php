@extends('layouts.app')
@section('content')
    <div class="container">

        <h1>Asignar Dispositivo</h1>
        <br>
        <form action=" {{ route('dispositivop.crear', $id) }} " method="post">
            @csrf

            <div class="form-group">
                <label>Modelo:</label>
                <input type="text" class="form-control" name="modelo" value=" {{ old('modelo') }}">
            </div>
            @error('modelo')
                ;
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
            <br>

            <div class="form-group">
                <label>Numero de Serie : </label>
                <input type="text" class="form-control" name="noserie" value=" {{ old('noserie') }}">
                @error('noserie')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>

            <div class="form-group">
                <label>Imei:</label>
                <input type="text" class="form-control" name="imei"value=" {{ old('imei') }}">
                @error('imei')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>



            <div class="form-group">
                <label>Cuenta:</label>
                <input type="text" class="form-control" name="cuenta"value=" {{ old('cuenta') }}">
                @error('cuenta')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>



            <div class="form-group">
                <label>sucursal:</label>
                <input type="text" class="form-control" name="sucursal"value=" {{ old('sucursal') }}">
                @error('sucursal')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>


            <div class="form-group">
                <label>Fecha Compra:</label>
                <input type="text" class="form-control" name="fechacompra"value=" {{ old('fechacompra') }}">
                @error('fechacompra')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>

            <div class="form-group">
                <label>numero Economico:</label>
                <input type="text" class="form-control" name="noeconomico"value=" {{ old('noeconomico') }}">
                @error('noeconomico')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>



            <div class="form-group">
                <label> Comentarios:</label>
                <input type="text" class="form-control" name="comentarios" value=" {{ old('comentarios') }}">
                @error('comentarios')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
            </div>
            <br>


            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Enviar Datos">
        </form>
    </div>
    </div>
@endsection
