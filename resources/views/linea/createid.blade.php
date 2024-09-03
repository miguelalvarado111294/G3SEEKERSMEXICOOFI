@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ route('lineap.crear', $id) }}" method="post">
            @csrf

            <div class="form-group">
                <label>Sim Card:</label>
                <input type="text" class="form-control" name="simcard">
            </div>
            <br>

            <div class="form-group">
                <label>Telefono : </label>
                <input type="text" class="form-control" name="telefono">
            </div>
            <br>

            <div class="form-group">
                <label>Tipo de Linea:</label>

                <select name="tipolinea" class="form-control">
                    <option value="voz">Voz</option>
                    <option value="datos" selected>Datos</option>
                </select>

            </div>
            <br>
            <div class="form-group">
                <label>Renovación:</label>
                <input type="text" class="form-control" name="renovacion">
            </div>
            <br>


            <div class="form-group">
                <label> Comentarios:</label>
                <input type="text" class="form-control" name="comentarios">
            </div>
            <br>


            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Enviar Datos">
        </form>
    </div>
    </div>
@endsection
