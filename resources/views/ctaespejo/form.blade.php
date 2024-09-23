<div class="form-group">
    <label for="usuario">usuario</label>
    <input type="text" class="form-control" name="usuario"
        value="{{ isset($ctaespejo->usuario) ? $ctaespejo->usuario : old('usuario') }}" id="usuario">
    @error('usuario')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="contrasenia">contrasenia</label>
    <input type="text" class="form-control" name="contrasenia"
        value="{{ isset($ctaespejo->contrasenia) ? $ctaespejo->contrasenia : old('contrasenia') }}" id="contrasenia">
    @error('contrasenia')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>



<div class="form-group">
    <label for="comentarios">Comentarios</label>
    <input type="text" class="form-control" name="contrasenia"
        value="{{ isset($ctaespejo->comentarios) ? $ctaespejo->comentarios : old('comentarios') }}" id="comentarios">
    @error('comentarios')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

{{--
    <div class="form-group">
        <label for="cliente_id">Cliente</label>
        <select class="form-control" name="cliente_id" >
            @foreach ($clientes as $cliente)
       <option value="{{isset($cliente->id)?$cliente->id:old('cliente_id')}}" id="cliente_id">{{ $cliente['nombre'] }} {{ $cliente['apellidopat'] }} {{ $cliente['apellidomat'] }} </option>
       @endforeach

   </div>
</select>
--}}

{{--
<div class="form-group">
    <label for="cuenta_id">cuenta_id</label>
    <select class="form-control" name="cuenta_id" >
        @foreach ($cuentas as $cuenta)
   <option value="{{isset($cuenta->id)?$cuenta->id:old('cuenta_id')}}" id="cuenta_id"> {{ $cuenta['usuario'] }} </option>
   @endforeach

</div>
</select>
--}}
<br>

<div class="form-group">
    <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
</div>

<br>
