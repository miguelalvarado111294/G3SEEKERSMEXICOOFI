<div class="form-group">
    <label for="usuario">Usuarioo</label>
    <input type="text" class="form-control" name="usuario" id="usuario" 
           value="{{ old('usuario', $ctaespejo->usuario ?? '') }}">
    @error('usuario')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="contrasenia">Contraseña</label>
    <input type="text" class="form-control" name="contrasenia" id="contrasenia" 
           value="{{ old('contrasenia', $ctaespejo->contrasenia ?? '') }}">
    @error('contrasenia')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="comentarios">Comentarios</label>
    <input type="text" class="form-control" name="comentarios" id="comentarios" 
           value="{{ old('comentarios', $ctaespejo->comentarios ?? '') }}">
    @error('comentarios')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    <input type="submit" class="btn btn-success" value="{{ $modo }} Datos">
</div>

