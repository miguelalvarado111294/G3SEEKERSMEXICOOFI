@extends('layouts.app')
@section('content')
    <div class="container">



        <form action="{{ route('vehiculop.crear', $id) }}" method="post">
            @csrf
            <div class="form-group">

                <h1>Asignar vehiculo </h1>
                <br>
                <div class="form-group">
                    <label>Tipo de Vehiculo:</label>

                    <select name="tipo" class="form-control">
                        <option value="trailer">Trailer</option>
                        <option value="tractocamion">Tractocamion</option>
                        <option value="motoneta">Motoneta</option>
                        <option value="motocicleta">Motocicleta</option>
                        <option value="auto" selected>Auto</option>
                        <option value="barco">Barco</option>
                        <option value="maquinaria_pesada">Maquinaria Pesada</option>
                        <option value="otro">Otro</option>
                    </select>

                </div>
                <br>
           

                    <label>Marca</label>
                    <input type="text" class="form-control" name="marca" value=" {{ old('marca') }} ">
                </div>
                @error('marca')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>


                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" class="form-control" name="modelo" value=" {{ old('modelo') }} ">
                </div>
                @error('modelo')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
                <br>

                <div class="form-group">
                    <label>Numero de Serie</label>
                    <input type="text" class="form-control" name="noserie" value=" {{ old('noserie') }} ">
                </div>
                @error('noserie')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
                <br>

                <div class="form-group">
                    <label>Numero de Motor</label>
                    <input type="text" class="form-control" name="nomotor" value=" {{ old('nomotor') }} ">
                </div>
                @error('nomotor')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
                <br>

                <div class="form-group">
                    <label>Numero de Placa:</label>
                    <input type="text" class="form-control" name="placa" value=" {{ old('placa') }} ">
                </div>
                @error('placa')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>
                <br>

                <div class="form-group">
                    <label>Color:</label>
                    <input type="text" class="form-control" name="color" value=" {{ old('color') }} ">
                </div>
                @error('color')
                    ;
                    <small style ="color: red"> {{ $message }}</small>
                @enderror
                <br>

                <br>
                <div class="form-group">
                    <label>Comentarios:</label>
                    <input type="text" class="form-control" name="comentarios" value=" {{ old('color') }} ">
                </div>
                <br>



                {{--
<div class="form-group">
    <div class="form-group">
        <label for="cuenta_id">cuentas</label>
        <select class="form-control" name="cuenta_id" >
            @foreach ($cuentas as $cuenta)
       <option value="{{isset($cuenta->id)?$cuenta->id:old('cuenta_id')}}" id="cuenta_id">

        {{ $cuenta['usuario'] }}

    </option>

    @endforeach

</select>
        </form>
    </div> --}}
                <input type="submit" class="btn btn-success" value="Enviar Datos">

            </div>
        @endsection
