
<div class="form-group">
    <label for="marca">Marca</label>
    <input type="text" class="form-control" name="marca"
        value="{{ isset($sensor->marca) ? $sensor->marca : old('marca') }}" id="marca">
    @error('marca')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="modelo">Modelo</label>
    <input type="text" class="form-control" name="modelo"
        value="{{ isset($sensor->modelo) ? $sensor->modelo : old('modelo') }}" id="modelo">
    @error('modelo')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="noserie">noserie</label>
    <input type="text" class="form-control" name="noserie"
        value="{{ isset($sensor->noserie) ? $sensor->noserie : old('noserie') }}" id="noserie">
    @error('noserie')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="tipo">Tipo</label>
    <input type="text" class="form-control" name="tipo"
        value="{{ isset($sensor->tipo) ? $sensor->tipo : old('tipo') }}" id="tipo">
    @error('tipo')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror

    <br>

    <div class="form-group">
        <label for="comentarios">comentarios</label>
        <input type="text" class="form-control" name="comentarios"
            value="{{ isset($cuenta->comentarios) ? $cuenta->comentarios : old('comentarios') }}" id="comentarios">
        @error('comentarios')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
    </div>


    <br><br>
    <div class="form-group">
        <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
    </div>

    <br>

    <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
