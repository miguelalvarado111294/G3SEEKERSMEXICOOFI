@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Datos Personales</h3>
    <br>

    <h1>Asignar Dispositivo</h1>
    <br>
    <form action=" {{ route('dispositivop.crear', $id) }} " method="post">
        @csrf

        <div class="form-group">
            <label>Id en Platadorma:</label>
            <input type="text" class="form-control" name="plataforma_id" value=" {{ old('plataforma_id') }}">
        </div>
        @error('platadorma_id')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>

        <div class="form-group">
            <label>Modelo:</label>
            <input type="text" class="form-control" name="modelo" value=" {{ old('modelo') }}">
        </div>
        @error('modelo')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label>Numero de Serie : </label>
            <input type="text" class="form-control" name="noserie" value=" {{ old('noserie') }}">
            @error('noserie')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>

        <div class="form-group">
            <label>Imei:</label>
            <input type="text" class="form-control" name="imei"value=" {{ old('imei') }}">
            @error('imei')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        
        <br>



        <div class="form-group">
            <label>Seleccione Cuenta:</label>

            <select name="cuenta" class="form-control">
                <option value="A">A</option>
                <option value="E">E</option>
                <option value="E2">E2</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
                <option value="J">J</option>
            </select>
            @error('cuenta')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>

        <br>



  {{--      <div class="form-group">
            <label>sucursal:</label>
            <input type="text" class="form-control" name="sucursal"value=" {{ old('sucursal') }}">

--}}
            <div class="form-group">
                <label>Sucursal:</label>

                <select name="sucursal" class="form-control">
                    <option value="Pachuca">Pachuca</option>
                    <option value="Oficinas_Centrales">Oficinas Centrales</option>
                    <option value="Ahuzastepec">huzastepec</option>
       
                </select>
            @error('sucursal')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>

        <div class="form-group">
            <label>Fecha Compra:</label>
            <input type="date" class="form-control" name="fechacompra" value="{{ old('fechacompra') }}">
            @error('fechacompra')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        </div>
    


        <div class="form-group">
            <label>Precio</label>
            <input type="text" class="form-control" name="precio" value="{{ old('precio') }}">
            @error('precio')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        </div>

        <br>

        <div class="form-group">
            <label>numero Economico:</label>
            <input type="text" class="form-control" name="noeconomico"value=" {{ old('noeconomico') }}">
            @error('noeconomico')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>



        <div class="form-group">
            <label> Observaciones:</label>
            <input type="text" class="form-control" name="comentarios" value=" {{ old('comentarios') }}">
            @error('comentarios')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
@endsection
