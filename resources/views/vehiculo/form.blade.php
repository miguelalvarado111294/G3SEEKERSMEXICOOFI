<div class="form-group">
    <label for="marca">Marca del Vehiculo</label>
    <input type="text" class="form-control" name="marca"
        value="{{ isset($vehiculo->marca) ? $vehiculo->marca : old('marca') }}" id="marca">
    @error('marca')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="modelo">Modelo del Vehiculo</label>
    <input type="text" class="form-control" name="modelo"
        value="{{ isset($vehiculo->modelo) ? $vehiculo->modelo : old('modelo') }}" id="modelo">
    @error('modelo')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="noserie">Numero de Serie</label>
    <input type="text" class="form-control" name="noserie"
        value="{{ isset($vehiculo->noserie) ? $vehiculo->noserie : old('noserie') }}" id="noserie">
    @error('noserie')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>


<div class="form-group">
    <label for="nomotor">Numero de Motor</label>
    <input type="text" class="form-control" name="nomotor"
        value="{{ isset($vehiculo->nomotor) ? $vehiculo->nomotor : old('nomotor') }}" id="nomotor">
    @error('nomotor')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>


<div class="form-group">
    <label for="placa">Placa</label>
    <input type="text" class="form-control" name="placa"
        value="{{ isset($vehiculo->placa) ? $vehiculo->placa : old('placa') }}" id="placa">
    @error('placa')
        <small style ="color: red"> {{ $message }}</small>
    @enderror

    <br>
</div>
<div class="form-group">
    <label for="color">Color</label>
    <input type="text" class="form-control" name="color"
        value="{{ isset($vehiculo->color) ? $vehiculo->color : old('color') }}" id="color">
    @error('color')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="comentarios">comentarios</label>
    <input type="text" class="form-control" name="comentarios"
        value="{{ isset($cuenta->comentarios) ? $cuenta->comentarios : old('comentarios') }}" id="comentarios">
    @error('contraseniaParo')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>
