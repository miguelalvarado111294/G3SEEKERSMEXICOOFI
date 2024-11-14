@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Crear Descripción y Fecha</h3>
    <br>

    <form action=" {{route('historialregister',$vehiculo_id)}} " method="post">
        @csrf

        <div class="form-group">
            <label>Descripción:</label>
            <textarea class="form-control" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
        </div>
        @error('descripcion')
            <small style="color: red">{{ $message }}</small>
        @enderror
        <br>


        <div class="form-group text-center">
            <input type="submit" class="btn btn-success" value="Guardar Datos">
        </div>
    </form>

    <div class="text-center">
        <h3>Historial del Vehículo</h3>
    
        <!-- Empezamos la card de Bootstrap -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Descripción y Fecha</h5>
            </div>
    
            <div class="card-body">
                <!-- Empezamos la tabla de Bootstrap -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Recorremos los datos del historial -->
                        @foreach ($historial as $value)
                            <tr>
                                <!-- Descripción -->
                                <td>{{ $value->descripcion }}</td>
    
                                <!-- Fecha -->
                                <td>{{ \Carbon\Carbon::parse($value->fecha)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <div class="text-center">
        <a href="{{ route('buscar.dispositivo', $vehiculo_id) }}" class="btn btn-dark">Regresar</a>
    </div>

@endsection
