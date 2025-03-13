<div class="card mt-4">
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
                    'actaconstitutiva' => 'Acta Constitutiva',
                    'consFiscal' => 'Constancia de Situación Fiscal',
                    'comprDom' => 'Comprobante de Domicilio',
                    'ine' => 'INE'
                ];
            @endphp

            @foreach ($fields as $name => $label)
                <div class="form-group">
                    <label for="{{ $name }}">{{ $label }}</label>
                    @if (in_array($name, ['actaconstitutiva', 'consFiscal', 'comprDom', 'ine']))
<<<<<<< HEAD
                        <input type="file" class="form-control upload-file" name="{{ $name }}" id="{{ $name }}" accept="image/*" data-field="{{ $name }}">
                        <small id="status-{{ $name }}" class="text-muted"></small>
                    @else
                        <input type="text" class="form-control" name="{{ $name }}" value="{{ old($name) }}" id="{{ $name }}">
                    @endif
                    @error($name)
                        <small style="color: red">{{ $message }}</small>
=======
                        <input type="file" class="form-control-file upload-file" name="{{ $name }}" id="{{ $name }}" accept="image/*,application/pdf" data-field="{{ $name }}">
                        <small id="status-{{ $name }}" class="text-muted"></small>
                    @else
                        <input type="{{ $name == 'email' ? 'email' : 'text' }}" class="form-control"
                               name="{{ $name }}" value="{{ old($name, $cliente->$name ?? '') }}" id="{{ $name }}"
                               {{ in_array($name, ['nombre', 'apellidopat', 'apellidomat', 'telefono', 'email', 'rfc']) ? 'required' : '' }}
                               {{ $name == 'telefono' ? 'pattern="[0-9]{10}" maxlength="10"' : '' }}>
                    @endif
                    @error($name)
                        <small class="text-danger">{{ $message }}</small>
>>>>>>> 9af01c4 (bugs)
                    @enderror
                </div>
            @endforeach

            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="{{ $modo }} datos">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <a href="{{ URL::previous() }}" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
</div>
