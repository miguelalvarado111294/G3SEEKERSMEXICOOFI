<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre"
        value="{{ isset($cliente->nombre) ? $cliente->nombre : old('nombre') }}" id="nombre">
    @error('nombre')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="segnombre">Segundo Nombre</label>
    <input type="text" class="form-control" name="segnombre"
        value="{{ isset($cliente->segnombre) ? $cliente->segnombre : old('segnombre') }}" id="segnombre">
    @error('segnombre')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="apellidopat">Apellido Paterno</label>
    <input type="text" class="form-control" name="apellidopat"
        value="{{ isset($cliente->apellidopat) ? $cliente->apellidopat : old('apellidopat') }}" id="apellidopat">
    @error('apellidopat')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="apellidomat">Apellido Materno</label>
    <input type="text" class="form-control" name="apellidomat"
        value="{{ isset($cliente->apellidomat) ? $cliente->apellidomat : old('apellidomat') }}" id="apellidomat">
    @error('apellidomat')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="telefono">Telefono</label>
    <input type="text" class="form-control" name="telefono"
        value="{{ isset($cliente->telefono) ? $cliente->telefono : old('telefono') }}" id="telefono">
    @error('telefono')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="direccion">Direccion</label>
    <input type="text" class="form-control" name="direccion"
        value="{{ isset($cliente->direccion) ? $cliente->direccion : old('direccion') }}" id="direccion"
        placeholder="Calle /Numero /Colonia /Ciudad">
    @error('direccion')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email"
        value="{{ isset($cliente->email) ? $cliente->email : old('email') }}" id="email">
    @error('email')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="rfc">RFC</label>
    <input type="text" class="form-control" name="rfc"
        value="{{ isset($cliente->rfc) ? $cliente->rfc : old('rfc') }}" id="rfc">
    @error('rfc')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="actaconstitutiva">Acta Constitutiva</label><br>
 {{--    <img src="{{ asset('storage/') . '/' . $cliente->actaconstitutiva }}" width="200" alt="">    <br>--}}
    <input type="file" class="form-control" name="actaconstitutiva"
        value="{{ isset($cliente->actaconstitutiva) ? $cliente->actaconstitutiva : old('actaconstitutiva') }}"
        accept="image/*" id="actaconstitutiva">
    @error('actaconstitutiva')
        <small style ="color: red"> {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="consFiscal">Constancia de Situación Fiscal</label><br>
    {{-- <img src="{{ asset('storage/') . '/' . $cliente->consFiscal }}" width="200" alt="">    <br>--}}

    <input type="file" class="form-control" name="consFiscal"
        value="{{ isset($cliente->consFiscal) ? $cliente->consFiscal : old('consFiscal') }} " id="consFiscal">
    @error('consFiscal')
        <small style ="color: red">
            {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="comprDom">Comprobante de Domicilio</label><br>
    {{-- <img src="{{ asset('storage/') . '/' . $cliente->comprDom }}" width="200" alt="">    <br>--}}

    <input type="file" class="form-control" name="comprDom"
        value="{{ isset($cliente->comprDom) ? $cliente->comprDom : old('comprDom') }}" id="comprDom">
    @error('comprDom')
        <small style ="color: red">
            {{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="tarjetacirculacion">Tarjeta de Circulacion</label><br>
    {{-- <img src="{{ asset('storage/') . '/' . $cliente->tarjetacirculacion }}" width="200" alt="">--}}
    <br>
    <input type="file" class="form-control" name="tarjetacirculacion"
        value="{{ isset($cliente->tarjetacirculacion) ? $cliente->tarjetacirculacion : old('tarjetacirculacion') }} "
        id="tarjetacirculacion">
    @error('tarjetacirculacion')
        <small style ="color: red">
            {{ $message }}</small>
    @enderror
</div>



<div class="form-group">
    <label for="compPago">Comprobante de Pago </label>
    <br>
   {{--  <img src="{{ asset('storage/') . '/' . $cliente->compPago }}" width="200" alt=""> --}}
    <input type="file" class="form-control" name="compPago"
        value="{{ isset($cliente->compPago) ? $cliente->compPago : old('compPago') }} " id="compPago">
    @error('compPago')
        <small style ="color: red">
            {{ $message }}</small>
    @enderror
</div>


<div class="row">
    <div class="col-sm-7">
        <div class="form-group">
            <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">
        </div>
    </div>
</div>

<div class="form-group">
    <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
</div>
