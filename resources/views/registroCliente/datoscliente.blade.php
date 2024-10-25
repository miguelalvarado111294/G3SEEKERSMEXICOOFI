@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
<h1 class="text-center"><b>G3 Seekers México</b></h1>
<br>
<h2 class="text-center">Registro Nuevo</h2>
<br>

<div class="card">
    <div class="card-body">
        <form action="{{ route('create.nuevo') }}" method="post" enctype="multipart/form-data">
            @csrf

            @php
                $fields = [
                    'nombre' => 'Nombre',
                    'segnombre' => 'Segundo Nombre',
                    'apellidopat' => 'Apellido Paterno',
                    'apellidomat' => 'Apellido Materno',
                    'telefono' => 'Teléfono',
                    'direccion' => 'Dirección',
                    'email' => 'Email',
                    'rfc' => 'RFC',
                ];
            @endphp

            @foreach ($fields as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}</label>
                    <input type="text" class="form-control" name="{{ $field }}"
                           value="{{ old($field, isset($cliente) ? $cliente->$field : '') }}" id="{{ $field }}"
                           placeholder="{{ $label }}">
                    @error($field)
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach

            @php
                $fileFields = [
                    'actaconstitutiva' => 'Acta Constitutiva',
                    'consFiscal' => 'Constancia de Situación Fiscal',
                    'comprDom' => 'Comprobante de Domicilio',
                    'tarjetacirculacion' => 'Tarjeta de Circulación',
                    'compPago' => 'Comprobante de Pago',
                ];
            @endphp

            @foreach ($fileFields as $field => $label)
                <div class="form-group">
                    <label for="{{ $field }}">{{ $label }}</label><br>
                    <input type="file" class="form-control" name="{{ $field }}" id="{{ $field }}" accept="image/*">
                    @error($field)
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach

            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="Registrar Cliente">
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
