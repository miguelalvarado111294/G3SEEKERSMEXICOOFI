<h1>{{ $modo }} Cuentas </h1>
<br>

<br>

<div class="form-group">
    <label for="usuario">usuario</label>
    <input type="text" class="form-control" name="usuario"
        value="{{ isset($cuenta->usuario) ? $cuenta->usuario : old('usuario') }}" id="usuario">
    @error('usuario')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="contrasenia">contrasenia</label>
    <input type="text" class="form-control" name="contrasenia"
        value="{{ isset($cuenta->contrasenia) ? $cuenta->contrasenia : old('contrasenia') }}" id="contrasenia">
    @error('contrasenia')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>



<div class="form-group">
    <label for="contraseniaParo">contraseniaParo</label>
    <input type="text" class="form-control" name="contraseniaParo"
        value="{{ isset($cuenta->contraseniaParo) ? $cuenta->contraseniaParo : old('contraseniaParo') }}"
        id="contraseniaParo">
    @error('contraseniaParo')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="comentarios">comentarios</label>
    <input type="text" class="form-control" name="comentarios"
        value="{{ isset($cuenta->comentarios) ? $cuenta->comentarios : old('comentarios') }}" id="comentarios">
    @error('contraseniaParo')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>




<br>

<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>

<br><br>

<div class="form-group">
    <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
</div>
<br>
