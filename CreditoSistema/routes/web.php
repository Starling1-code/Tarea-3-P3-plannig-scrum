<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CREDITOSController;
use App\Http\Controllers\ComisionAgregar;
use App\Http\Controllers\FrecuenciaAgregar;
use App\Console\UpdatePlanPago;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/', [CREDITOSController::Class, 'index']);

Route::get('/credito', [CREDITOSController::Class, 'index'])->name('credito.index');
//Route::get('/credito/PlanPago', [CREDITOSController::Class, 'index1'])->name('credito.index1');
Route::get('/credito/serch', [CREDITOSController::Class, 'filtros'])->name('credito.filtros');
Route::get('/credito/serchtype', [CREDITOSController::Class, 'filtrosTipo'])->name('credito.filtrosTipo');
Route::get('/credito/CalcularIntereses', [CREDITOSController::Class, 'calcular'])->name('credito.calcular');
Route::get('/credito/CalcularInteresesSerch', [CREDITOSController::Class, 'Insertar'])->name('credito.calcularSerch');
Route::get('/credito/update', [CREDITOSController::Class, 'update'])->name('credito.update');
Route::get('/credito/UpdatePlanPago', [CREDITOSController::Class, 'UpdatePlanPago'])->name('credito.UpdatePlanPago');
Route::get('/credito/UpdatePrueba', [UpdatePlanPago::Class, 'DataPlanPago'])->name('credito.UpdatePlanPagoSP');
Route::get('/credito/ActualizarC', [CREDITOSController::Class, 'ActualizarC'])->name('credito.ActualizarC');
Route::get('/credito/InsertarCuota', [CREDITOSController::Class, 'InsertarCuota'])->name('credito.InsertarCuota');
//Route::get('/credito/Insertar', [CREDITOSController::Class, 'Insertar'])->name('credito.update');


//Comision Agregar
Route::get('Actualizar/Comision', [ComisionAgregar::Class, 'Index'])->name('Actualizar.Comision');
Route::get('Comision/serch', [ComisionAgregar::Class, 'filtros'])->name('Comision.filtros');
Route::get('/credito/UpdatePlanPagoC', [ComisionAgregar::Class, 'UpdatePlanPago'])->name('credito.UpdatePlanPagoC');

//Frecuencia Agregar
Route::get('Actualizar/Frecuencia', [FrecuenciaAgregar::Class, 'Index'])->name('ActualizarF.Frecuencia');
Route::get('Frecuencia/serch', [FrecuenciaAgregar::Class, 'filtros'])->name('Frecuencia.filtros');
Route::get('/Frecuencia/Actualizar', [FrecuenciaAgregar::Class, 'ActualizarC'])->name('credito.Actualizar');










