<h1>{{ $modo }} Cuentas Espejo secundaria</h1>
<br>

<div class="form-group">
    <label for="usuario">usuario</label>
    <input type="text" class="form-control" name="usuario"
        value="{{ isset($ctaespejosecundaria->usuario) ? $ctaespejosecundaria->usuario : old('usuario') }}"
        id="usuario">
    @error('usuario')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="contrasenia">contrasenia</label>
    <input type="text" class="form-control" name="contrasenia"
        value="{{ isset($ctaespejosecundaria->contrasenia) ? $ctaespejosecundaria->contrasenia : old('contrasenia') }}"
        id="contrasenia">
    @error('contrasenia')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="ctaespejo_id">cuenta espejo</label>
    <select class="form-control" name="ctaespejo_id">
        @foreach ($ctaespejos as $ctaespejo)
            <option value="{{ isset($ctaespejo->id) ? $ctaespejo->id : old('ctaespejo_id') }}" id="ctaespejo_id">
                {{ $ctaespejo['id'] }} </option>
        @endforeach

</div>
</select>



<br>

<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>

<br><br>

<div class="form-group">
    <a href="{{ url('/cuenta') }}" class="btn btn-dark">Regresar</a>
</div>
<br>
