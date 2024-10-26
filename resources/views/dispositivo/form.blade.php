<div class="form-group">
    <label for="modelo">Modelo</label>
    <input type="text" class="form-control" name="modelo"
        value="{{ old('modelo', isset($dispositivo->modelo) ? $dispositivo->modelo : '') }}" id="modelo">
    @error('modelo')
        <small style="color: red">{{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="noserie">Número de Serie</label>
    <input type="text" class="form-control" name="noserie"
        value="{{ old('noserie', isset($dispositivo->noserie) ? $dispositivo->noserie : '') }}" id="noserie">
    @error('noserie')
        <small style="color: red">{{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="imei">IMEI</label>
    <input type="text" class="form-control" name="imei"
        value="{{ old('imei', isset($dispositivo->imei) ? $dispositivo->imei : '') }}" id="imei">
    @error('imei')
        <small style="color: red">{{ $message }}</small>
    @enderror
    <br>
</div>

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

<div class="form-group">
    <label>Sucursal:</label>

    <select name="sucursal" class="form-control">
        <option value="Pachuca">Pachuca</option>
        <option value="Oficinas_Centrales">Oficinas Centrales</option>
        <option value="Ahuzastepec">huzastepec</option>

    </select>

<div class="form-group">
    <label for="fechacompra">Fecha de Compra</label>
    <input type="date" class="form-control" name="fechacompra"
        value="{{ old('fechacompra', isset($dispositivo->fechacompra) ? $dispositivo->fechacompra : '') }}"
        id="fechacompra">
    @error('fechacompra')
        <small style="color: red">{{ $message }}</small>
    @enderror
    <br>
</div>


<div class="form-group">
    <label for="noeconomico">Número Económico</label>
    <input type="text" class="form-control" name="noeconomico"
        value="{{ old('noeconomico', isset($dispositivo->noeconomico) ? $dispositivo->noeconomico : '') }}"
        id="noeconomico">
    @error('noeconomico')
        <small style="color: red">{{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="comentarios">Comentarios</label>
    <input type="text" class="form-control" name="comentarios"
        value="{{ old('comentarios', isset($cuenta->comentarios) ? $cuenta->comentarios : '') }}" id="comentarios">
    @error('comentarios')
        <small style="color: red">{{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>

<br>
<a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
<br><br>
