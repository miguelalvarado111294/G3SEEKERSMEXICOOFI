<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::resource('/user', App\Http\Controllers\UserController::class)->names('admin.users');

    Route::get('/admin/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.edit');
    Route::get('/admin/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.update');
    Route::get('/admin/destroy/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.destroy');


    Route::resource('referencia', App\Http\Controllers\ReferenciaController::class);
    Route::resource('cliente',  App\Http\Controllers\ClienteController::class);
    Route::get('/cliente/{id}',                 [App\Http\Controllers\ClienteController::class, 'show'])->name('cliente.show');
    Route::get('cliente/{id}/buscararchivos',   [App\Http\Controllers\ClienteController::class, 'buscararchivos'])->name('buscar.buscararchivos');
    Route::resource('vehiculo', App\Http\Controllers\VehiculoController::class);
    Route::resource('linea',    App\Http\Controllers\LineaController::class);
    Route::resource('cuenta',   App\Http\Controllers\CuentaController::class);
    Route::resource('ctaespejo', App\Http\Controllers\CtaespejoController::class);
    Route::resource('dispositivo', App\Http\Controllers\DispositivoController::class);
    Route::resource('sensor', App\Http\Controllers\SensorController::class);

    Route::get('/cliente/{id}',                 [App\Http\Controllers\ClienteController::class, 'show'])->name('cliente.show');
    Route::get('cliente/{id}/buscararchivos',   [App\Http\Controllers\ClienteController::class, 'buscararchivos'])->name('buscar.buscararchivos');

    Route::get('/referencia/crearref/{id}',     [App\Http\Controllers\ReferenciaController::class, 'crearref'])->name('referenciaf.crear');;
    Route::post('/referencia/{id}',             [App\Http\Controllers\ReferenciaController::class, 'storef'])->name('referenciap.crear');

    Route::get('/prueba/{id}/buscarVehiculo',   [App\Http\Controllers\PruebaController::class, 'buscarVehiculo'])->name('buscar.vehiculo');

    Route::get('/prueba/{id}/buscarVehiculo',   [App\Http\Controllers\PruebaController::class, 'buscarVehiculo'])->name('buscar.vehiculo');
    Route::get('/prueba/{id}/',   [App\Http\Controllers\PruebaController::class, 'buscadorvehiculo'])->name('buscador.vehiculo');

    Route::get('/vehiculo/crearvehi/{id}',      [App\Http\Controllers\VehiculoController::class, 'crearvehi'])->name('vehiculof.crear');
    Route::post('/vehiculo/{id}',               [App\Http\Controllers\VehiculoController::class, 'stovehi'])->name('vehiculop.crear');

    Route::get('/prueba/{id}/buscarCuenta',     [App\Http\Controllers\PruebaController::class, 'buscarCuenta'])->name('buscar.cuenta');
    Route::get('/cuenta/crearcta/{id}',         [App\Http\Controllers\CuentaController::class, 'crearcta'])->name('cuentaf.crear');
    Route::post('/cuenta/{id}',                 [App\Http\Controllers\CuentaController::class, 'stocta'])->name('cuentap.crear');

    Route::get('/prueba/{id}/buscarLinea',      [App\Http\Controllers\PruebaController::class, 'buscarLinea'])->name('buscar.linea');
    Route::get('/linea/crearlinea/{id}',        [App\Http\Controllers\LineaController::class, 'crearlinea'])->name('lineaf.crear');
    Route::post('/linea/{id}',                  [App\Http\Controllers\LineaController::class, 'storep'])->name('lineap.crear');

    Route::get('/prueba/{id}/buscarDispositivo', [App\Http\Controllers\PruebaController::class, 'buscarDispositivo'])->name('buscar.dispositivo');
    Route::get('/dispositivo/creardisp/{id}',   [App\Http\Controllers\DispositivoController::class, 'creardisp'])->name('dispositivof.crear');;
    Route::post('/dispositivo/{id}',            [App\Http\Controllers\DispositivoController::class, 'stodis'])->name('dispositivop.crear');

    Route::get('/prueba/{id}/buscarSensor',     [App\Http\Controllers\PruebaController::class, 'buscarSensor'])->name('buscar.sensor');
    Route::get('/sensor/crearsens/{id}',   [App\Http\Controllers\SensorController::class, 'crearsens'])->name('sensorf.crear');;
    Route::post('/sensor/{id}',            [App\Http\Controllers\SensorController::class, 'stosens'])->name('sensorp.crear');

    Route::get('/prueba/{id}/buscarctaespejo',     [App\Http\Controllers\PruebaController::class, 'buscarCtaespejo'])->name('buscar.ctaespejo');
    Route::get('/ctaespejo/crearctaespejo/{id}',   [App\Http\Controllers\CtaespejoController::class, 'crearctaespejo'])->name('ctaesoejof.crear');;
    Route::post('/ctaespejo/{id}',            [App\Http\Controllers\CtaespejoController::class, 'storectaespejo'])->name('ctaespejop.crear');


    Route::get('/crear' ,   [App\Http\Controllers\ClienteController::class, 'crearcliente'])->name('crear.nuevo');
    Route::post('/create' ,   [App\Http\Controllers\ClienteController::class, 'createnuevo'])->name('create.nuevo');

   Route::get('/crearr/{id}' ,   [App\Http\Controllers\ReferenciaController::class, 'crearr'])->name('crear.nuevo.ref');
   Route::post('/create/{id}' ,   [App\Http\Controllers\ReferenciaController::class, 'createnuevoref'])->name('create.nuevo.ref');

   Route::get('/crearc/{id}' ,   [App\Http\Controllers\CuentaController::class, 'crearc'])->name('crear.nuevo.cuenta');
   Route::post('/createc/{id}' ,   [App\Http\Controllers\CuentaController::class, 'createnuevocta'])->name('create.nuevo.cta');



});
