<div class="form-group">
    <label for="modelo">Modelo</label>
    <input type="text" class="form-control" name="modelo"
        value="{{ isset($dispositivo->modelo) ? $dispositivo->modelo : old('modelo') }}" id="modelo">
    @error('modelo')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="noserie">Numero de Serie</label>
    <input type="text" class="form-control" name="noserie"
        value="{{ isset($dispositivo->noserie) ? $dispositivo->noserie : old('noserie') }}" id="noserie">
    @error('noserie')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="imei">Imei</label>
    <input type="text" class="form-control" name="imei"
        value="{{ isset($dispositivo->imei) ? $dispositivo->imei : old('imei') }}" id="imei">
    @error('imei')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>


<div class="form-group">
    <label for="cuenta">Cuenta</label>
    <input type="text" class="form-control" name="cuenta"
        value="{{ isset($dispositivo->cuenta) ? $dispositivo->cuenta : old('cuenta') }}" id="cuenta">
    @error('cuenta')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>



<div class="form-group">
    <label for="sucursal">Sucursal</label>
    <input type="text" class="form-control" name="sucursal"
        value="{{ isset($dispositivo->sucursal) ? $dispositivo->sucursal : old('sucursal') }}" id="sucursal">
    @error('sucursal')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="fechacompra">Fecha de compra</label>
    <input type="text" class="form-control" name="fechacompra"
        value="{{ isset($dispositivo->fechacompra) ? $dispositivo->fechacompra : old('fechacompra') }}"
        id="fechacompra">
    @error('fechacompra')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="noeconomico">Numero Economico</label>
    <input type="text" class="form-control" name="noeconomico"
        value="{{ isset($dispositivo->noeconomico) ? $dispositivo->noeconomico : old('noeconomico') }}"
        id="noeconomico">
    @error('noeconomico')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>


<div class="form-group">
    <label for="comentarios">Comentarios</label>
    <input type="text" class="form-control" name="comentarios"
        value="{{ isset($cuenta->comentarios) ? $cuenta->comentarios : old('comentarios') }}" id="comentarios">
    @error('comentarios')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>

<br>
<a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>


<br><br>
