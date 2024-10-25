@php
    // Define un array con los campos que quieres mostrar
    $fields = [
        'nombre' => 'Nombre',
        'segnombre' => 'Segundo Nombre',
        'apellidopat' => 'Apellido Paterno',
        'apellidomat' => 'Apellido Materno',
        'telefono' => 'Teléfono',
        'direccion' => 'Dirección',
        'email' => 'Email',
        'rfc' => 'RFC',
        'actaconstitutiva' => 'Acta Constitutiva',
        'consFiscal' => 'Constancia de Situación Fiscal',
        'comprDom' => 'Comprobante de Domicilio',
        'tarjetacirculacion' => 'Tarjeta de Circulación',
        'compPago' => 'Comprobante de Pago',
    ];
@endphp

@foreach ($fields as $name => $label)
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        @if (in_array($name, ['actaconstitutiva', 'consFiscal', 'comprDom', 'tarjetacirculacion', 'compPago']))
            <input type="file" class="form-control" name="{{ $name }}" id="{{ $name }}" accept="image/*">
        @else
            <input type="text" class="form-control" name="{{ $name }}"
                value="{{ isset($cliente->$name) ? $cliente->$name : old($name) }}" id="{{ $name }}">
        @endif
        @error($name)
            <small style="color: red">{{ $message }}</small>
        @enderror
    </div>
@endforeach

<div class="row">
    <div class="col-sm-7">
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="{{ $modo }} datos">
        </div>
    </div>
</div>

<div class="form-group">
    <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
</div>
