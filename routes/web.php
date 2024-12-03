<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Auth::routes(['register'=>false,'reset'=>false]);


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index']);

    Route::resource('/user', App\Http\Controllers\UserController::class)->names('admin.users');



    Route::prefix('admin')->group(function () {
        Route::get('edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.edit');
        Route::put('update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.update'); // Cambia GET a PUT
        Route::delete('destroy/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.destroy');
    });
    


    Route::resources([
        'referencia' => App\Http\Controllers\ReferenciaController::class,
        'cliente' => App\Http\Controllers\ClienteController::class,
        'vehiculo' => App\Http\Controllers\VehiculoController::class,
        'linea' => App\Http\Controllers\LineaController::class,
        'cuenta' => App\Http\Controllers\CuentaController::class,
        'ctaespejo' => App\Http\Controllers\CtaespejoController::class,
        'dispositivo' => App\Http\Controllers\DispositivoController::class,
        'sensor' => App\Http\Controllers\SensorController::class,
    ]);

    Route::get('/cliente/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('cliente.show');
    Route::get('/cliente/{id}/buscararchivos', [App\Http\Controllers\ClienteController::class, 'buscararchivos'])->name('buscar.buscararchivos');

    Route::prefix('referencia')->group(function () {
        Route::get('crearref/{id}', [App\Http\Controllers\ReferenciaController::class, 'crearref'])->name('referenciaf.crear');
        Route::post('{id}', [App\Http\Controllers\ReferenciaController::class, 'storef'])->name('referenciap.crear');
    });

    Route::prefix('prueba/{id}')->group(function () {
        Route::get('buscarVehiculo', [App\Http\Controllers\PruebaController::class, 'buscarVehiculo'])->name('buscar.vehiculo');
        Route::get('/', [App\Http\Controllers\PruebaController::class, 'buscadorvehiculo'])->name('buscador.vehiculo');
        Route::get('buscarCuenta', [App\Http\Controllers\PruebaController::class, 'buscarCuenta'])->name('buscar.cuenta');
        Route::get('buscarLinea', [App\Http\Controllers\PruebaController::class, 'buscarLinea'])->name('buscar.linea');
        Route::get('buscarDispositivo', [App\Http\Controllers\PruebaController::class, 'buscarDispositivo'])->name('buscar.dispositivo');
        Route::get('buscarSensor', [App\Http\Controllers\PruebaController::class, 'buscarSensor'])->name('buscar.sensor');
        Route::get('buscarctaespejo', [App\Http\Controllers\PruebaController::class, 'buscarCtaespejo'])->name('buscar.ctaespejo');
    });

    Route::prefix('vehiculo')->group(function () {
        Route::get('crearvehi/{id}', [App\Http\Controllers\VehiculoController::class, 'crearvehi'])->name('vehiculof.crear'); 
        Route::post('crearvehi/{id}', [App\Http\Controllers\VehiculoController::class, 'createvehiculo'])->name('vehiculop.crear'); // Asegúrate de que esta ruta coincide
    });
    

    Route::prefix('cuenta')->group(function () {
        Route::get('crearcta/{id}', [App\Http\Controllers\CuentaController::class, 'crearcta'])->name('cuentaf.crear');
        Route::post('{id}', [App\Http\Controllers\CuentaController::class, 'stocta'])->name('cuentap.crear');
    });

    Route::prefix('linea')->group(function () {
        Route::get('crearlinea/{id}', [App\Http\Controllers\LineaController::class, 'crearlinea'])->name('lineaf.crear');
        Route::post('{id}', [App\Http\Controllers\LineaController::class, 'storep'])->name('lineap.crear');
    });

    Route::prefix('dispositivo')->group(function () {
        Route::get('creardisp/{id}', [App\Http\Controllers\DispositivoController::class, 'creardisp'])->name('dispositivof.crear');
        Route::post('{id}', [App\Http\Controllers\DispositivoController::class, 'stodis'])->name('dispositivop.crear');

        
    });

    Route::put('/linea/{linea}', [App\Http\Controllers\LineaController::class, 'updateLinea'])->name('linea.update');

    Route::get('/ruta/a/tu/controlador/{id}', [App\Http\Controllers\DispositivoController::class, 'obtenerDispositivo']);

    Route::get('/dispositivo/{id}', [App\Http\Controllers\DispositivoController::class, 'getDispositivo']);


    Route::prefix('sensor')->group(function () {
        Route::get('crearsens/{id}', [App\Http\Controllers\SensorController::class, 'crearsens'])->name('sensorf.crear');
        Route::post('{id}', [App\Http\Controllers\SensorController::class, 'stosens'])->name('sensorp.crear');
    });

    Route::prefix('ctaespejo')->group(function () {
        Route::get('crearctaespejo/{id}', [App\Http\Controllers\CtaespejoController::class, 'crearctaespejo'])->name('ctaesoejof.crear');
        Route::post('{id}', [App\Http\Controllers\CtaespejoController::class, 'storectaespejo'])->name('ctaespejop.crear');
    });

    Route::prefix('clientes')->group(function () {
        Route::get('crear', [App\Http\Controllers\ClienteController::class, 'crearcliente'])->name('crear.nuevo');
        Route::post('create', [App\Http\Controllers\ClienteController::class, 'createnuevo'])->name('create.nuevo');
    });

    Route::prefix('referencias')->group(function () {
        Route::get('crearr/{id}', [App\Http\Controllers\ReferenciaController::class, 'crearr'])->name('crear.nuevo.ref');
        
        Route::post('create/{id}', [App\Http\Controllers\ReferenciaController::class, 'createnuevoref'])->name('create.nuevo.ref');
    });




    Route::prefix('cuentas')->group(function () {
        Route::get('crearc/{id}', [App\Http\Controllers\CuentaController::class, 'crearc'])->name('crear.nuevo.cuenta');
        Route::post('createc/{id}', [App\Http\Controllers\CuentaController::class, 'createnuevocta'])->name('create.nuevo.cta');
    });

    Route::get('/crearcita/{vehiculo}', [App\Http\Controllers\ClienteController::class, 'crearcita'])->name('crear.cita');
    Route::post('/orden/{vehiculoid}', [App\Http\Controllers\ClienteController::class, 'orden'])->name('crear.ordens');
    Route::get('/orden', [App\Http\Controllers\ClienteController::class, 'orden'])->name('crear.orden');
    Route::get('/ordeninstalacion', [App\Http\Controllers\ClienteController::class, 'ordeninstalacion'])->name('ordeninstalacion');
    Route::post('/ordenins', [App\Http\Controllers\ClienteController::class, 'ordenins'])->name('ordenins');

    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

    Route::get('/formsearch', [App\Http\Controllers\BusquedaController::class, 'formsearch'])->name('formsearch');
    Route::get('/search', [App\Http\Controllers\BusquedaController::class, 'search'])->name('search');


    Route::get('/confirmation', [App\Http\Controllers\BusquedaController::class, 'confirmation'])->name('confirmation');
    Route::get('/ale', [App\Http\Controllers\CtaespejoController::class, 'ale'])->name('ale');

    Route::get('/inventariostok', [App\Http\Controllers\FuncionesController::class, 'stok'])->name('inventario.stok');

    Route::get('/inventarioadd', [App\Http\Controllers\FuncionesController::class, 'inventarioadd'])->name('inventarioadd');
    Route::post('/inventario', [App\Http\Controllers\FuncionesController::class, 'store'])->name('store.inventario');

    Route::get('/vehiculo/{vehiculo_id}/historial', [App\Http\Controllers\DispositivoController::class, 'historial'])->name('historial');

    Route::post('/vehiculo/{vehiculo_id}/savehistorial', [App\Http\Controllers\DispositivoController::class, 'historialregister'])->name('historialregister');
   
   
    Route::get('renovaciones', [App\Http\Controllers\FuncionesController::class, 'renovaciones'])->name('renovaciones');

    Route::get('/renovacionessearch', [App\Http\Controllers\FuncionesController::class, 'renovacionessearch'])->name('renovacionessearch');

});
