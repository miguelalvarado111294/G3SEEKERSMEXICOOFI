<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">Formulario de Cliente</h5>
            </div>
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
                            /*
                            'actaconstitutiva' => 'Acta Constitutiva',
                            'consFiscal' => 'Constancia de Situación Fiscal',
                            'comprDom' => 'Comprobante de Domicilio',
                            'ine' => 'INE'
                            */
                        ];
                    @endphp

                    @foreach ($fields as $name => $label)
                        <div class="form-group">
                            <label for="{{ $name }}">{{ $label }}</label>
                            @if (in_array($name, ['actaconstitutiva', 'consFiscal', 'comprDom', 'ine']))
                                <input type="file" class="form-control-sm form-control upload-file" name="{{ $name }}" id="{{ $name }}" accept="image/*" data-field="{{ $name }}">
                                <small id="status-{{ $name }}" class="text-muted"></small>
                            @else
                                <input type="{{ $name == 'email' ? 'email' : 'text' }}" 
                                       class="form-control form-control-sm"
                                       name="{{ $name }}" 
                                       value="{{ old($name, $cliente->$name ?? '') }}" 
                                       id="{{ $name }}">
                            @endif
                            @error($name)
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">{{ $modo }} datos</button>
                        <a href="{{ URL::previous() }}" class="btn btn-dark ml-2">Volver Atrás</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
