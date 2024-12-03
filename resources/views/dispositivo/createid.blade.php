@extends('adminlte::page')

@section('title', 'G3SEEKERSMX')

@section('css')
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome (iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">
@endsection




@section('content_header')
    <h1 class="text-center"><b>G3 Seekers México</b></h1>
    <br>
    <h3 class="text-center">Asignar dispositivo</h3>
    <br>

    <a href="" class="btn btn-primary btn-sm">Asignar Desde Inventario</a>



    <br>
    <form action=" {{ route('dispositivop.crear', $id) }} " method="post">
        @csrf

        <div class="form-group">
            <label>Id en Platadorma:</label>
            <input type="text" class="form-control" name="plataforma_id" value=" {{ old('plataforma_id') }}">
        </div>
        @error('platadorma_id')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>

        <div class="form-group">
            <label>Modelo:</label>
            <input type="text" class="form-control" name="modelo" value=" {{ old('modelo') }}">
        </div>
        @error('modelo')
            <small style ="color: red"> {{ $message }}</small>
        @enderror
        <br>
        <br>

        <div class="form-group">
            <label>Numero de Serie : </label>
            <input type="text" class="form-control" name="noserie" value=" {{ old('noserie') }}">
            @error('noserie')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>

        <div class="form-group">
            <label>Imei:</label>
            <input type="text" class="form-control" name="imei"value=" {{ old('imei') }}">
            @error('imei')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        
        <br>



        <div class="form-group">
            <label>Seleccione Cuenta:</label>

            <select name="cuenta" class="form-control">
                <option value="E">E</option>
                <option value="E2">E2</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="J">J</option>
                <option value="K">K</option>
                <option value="Tijuani">Tijuani</option>

                

            </select>
            @error('cuenta')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>

        <br>



  {{--      <div class="form-group">
            <label>sucursal:</label>
            <input type="text" class="form-control" name="sucursal"value=" {{ old('sucursal') }}">

--}}
            <div class="form-group">
                <label>Sucursal:</label>

                <select name="sucursal" class="form-control">
                    <option value="Pachuca">Pachuca</option>
                    <option value="Oficinas_Centrales">Oficinas Centrales</option>
                    <option value="Ahuzastepec">huzastepec</option>
       
                </select>
            @error('sucursal')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>

        <div class="form-group">
            <label>Fecha Instalacion:</label>
            <input type="date" class="form-control" name="fechacompra" value="{{ old('fechacompra') }}">
            @error('fechacompra')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        </div>
    


        <div class="form-group">
            <label>Ubicacion Dispositivo</label>
            <input type="text" class="form-control" name="ubicaciondispositivo" value="{{ old('ubicaciondispositivo') }}">
            @error('ubicaciondispositivo')
                <small style="color: red">{{ $message }}</small>
            @enderror
            <br>
        </div>

        <br>

        <div class="form-group">
            <label>numero Economico:</label>
            <input type="text" class="form-control" name="noeconomico"value=" {{ old('noeconomico') }}">
            @error('noeconomico')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>



        <div class="form-group">
            <label> Observaciones:</label>
            <input type="text" class="form-control" name="comentarios" value=" {{ old('comentarios') }}">
            @error('comentarios')
                <small style ="color: red"> {{ $message }}</small>
            @enderror
            <br>
        </div>
        <br>


        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Enviar Datos">
    </form>
    </div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Popper.js (necesario para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop