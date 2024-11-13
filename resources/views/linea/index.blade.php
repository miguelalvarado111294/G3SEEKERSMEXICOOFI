@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <h3 class="text-center">Lineas</h3>
    
    <!-- Cuadro para el contador -->
    <div class="d-flex justify-content-center mb-4">
        <div class="card text-center" style="display: inline-block; border: 2px solid #28a745; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            <div class="card-body" style="padding: 10px;">
                <h5 class="card-title" style="color: #28a745; font-size: 18px;">Total de Líneas</h5>
                <p class="card-text" style="font-size: 24px; font-weight: bold; color: #28a745;">
                    {{ $totalLineas }}
                </p>
            </div>
        </div>
    </div>

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form class="d-flex" role="search">
        <input name="busqueda" class="form-control me-2" type="search" value="{{ $busqueda }}"
            placeholder="Buscar por Sim Card/Numero de telefono/" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
    <br>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Simcard</th>
                        <th>Telefono</th>
                        <th>Tipo Línea</th>
                        <th>Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($lineas) <= 0)
                        <tr>
                            <td colspan="6">No hay resultados de "{{ $busqueda }}"</td>
                        </tr>
                    @else
                        @foreach ($lineas as $linea)
                            <tr>
                                <td>
                                    <a href="{{ route('buscar.linea', $linea->dispositivo_id) }}" class="btn btn-default"
                                       style="text-align: center; display: inline-block; width: 100%;">
                                        Ver detalles de: {{ $linea->id }}
                                    </a>
                                </td>
                                <td>{{ $linea->simcard }}</td>
                                <td>{{ $linea->telefono }}</td>
                                <td>{{ $linea->tipolinea }}</td>
                                <td>{{ $linea->cliente->nombre }} {{ $linea->cliente->segnombre }}
                                    {{ $linea->cliente->apellidopat }} {{ $linea->cliente->apellidomat }}</td>

                                <td>
                                    @can('linea.edit')
                                        <a href="{{ url('/linea/' . $linea->id . '/edit') }}"
                                           class="btn btn-warning">Editar</a>
                                    @endcan
                                    @can('linea.destroy')
                                        <form action="{{ url('/linea/' . $linea->id) }}" method="post" class="d-inline">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input class="btn btn-danger" type="submit"
                                                   onclick="return confirm('¿Seguro quieres eliminar?')" value="Borrar">
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <br>


   
 
    
    <div class="d-flex justify-content-center">
        {!! $lineas->links() !!}

    </div>
@endsection
