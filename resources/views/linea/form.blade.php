<h1>{{ $modo }} Linea </h1>
<br>

<div class="form-group">
    <label for="nombre">simcard</label>

    <input type="text" class="form-control" name="simcard"
        value="{{ isset($linea->simcard) ? $linea->simcard : old('simcard') }}" id="simcard">
    @error('simcard')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror

    <br>
</div>

<div class="form-group">
    <label for="telefono">telefono</label>
    <input type="text" class="form-control" name="telefono"
        value="{{ isset($linea->telefono) ? $linea->telefono : old('telefono') }}" id="telefono">
    @error('telefono')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror

    <br>
</div>
<div class="form-group">
    <label for="tipolinea">tipolinea</label>
    <input type="text" class="form-control" name="tipolinea"
        value="{{ isset($linea->tipolinea) ? $linea->tipolinea : old('tipolinea') }}" id="tipolinea">
    @error('tipolinea')
        ;
        <small style ="color: red"> {{ $message }}</small>
    @enderror
    <br>

    <div class="form-group">
        <label for="renovacion">renovacion</label>
        <input type="text" class="form-control" name="renovacion"
            value="{{ isset($linea->renovacion) ? $linea->renovacion : old('renovacion') }}" id="renovacion">
        @error('renovacion')
            ;
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>

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


        <div class="form-group">
            <input class="btn btn-success" type="submit" class="form-control" value="{{ $modo }} datos">


        </div>

        <br><br><br>

        <div class="form-group">
            <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
        </div>
        <br>
