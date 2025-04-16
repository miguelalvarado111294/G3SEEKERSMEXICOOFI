<label>Tipo de Vehículo:</label>
            <select name="tipo" class="form-control">
                <option value="trailer">Trailer</option>
                <option value="tractocamion">Tractocamión</option>
                <option value="motoneta">Motoneta</option>
                <option value="motocicleta">Motocicleta</option>
                <option value="auto" selected>Auto</option>
                <option value="barco">Barco</option>
                <option value="camioneta">Camioneta</option>
                <option value="maquinaria_pesada">Maquinaria Pesada</option>
                <option value="otro">Otro</option>
            </select>

<br>

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
    <label for="tarjetacirculacion">Tarjeta de Circulación</label>
    <input type="file" class="form-control" name="tarjetacirculacion" id="tarjetacirculacion">
    
    @if (isset($vehiculo->tarjetacirculacion) && $vehiculo->tarjetacirculacion)
        <div class="mt-2">
            <label>Archivo actual:</label><br>
            <a href="{{ asset('storage/' . $vehiculo->tarjetacirculacion) }}" target="_blank">
                Ver Tarjeta de Circulación
            </a>
        </div>
    @endif

    @error('tarjetacirculacion')
        <small style="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>




<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>
