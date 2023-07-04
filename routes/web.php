<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversidadController;
use App\Http\Controllers\UniversidadSalonController;
use App\Http\Controllers\SalonController;


 
Route::get('/', [UniversidadController::class, 'index']);


Route::get('universidades', [UniversidadController::class, 'index'])->name('universidades.index');
Route::get('/universidades/create', [UniversidadController::class, 'create'])->name('universidades.create');
Route::post('universidades', [UniversidadController::class, 'store'])->name('universidades.store');
Route::get('universidades/{universidad}/edit', [UniversidadController::class, 'edit'])->name('universidades.edit');
Route::put('universidades/{universidad}', [UniversidadController::class, 'update'])->name('universidades.update');
Route::delete('universidades/{universidad}', [UniversidadController::class, 'destroy'])->name('universidades.destroy');

Route::get('/universidades/verificarNombre/{nombre}', [UniversidadController::class, 'verificarNombre'])->name('universidades.nombre');





Route::get('universidades_salones', [UniversidadSalonController::class, 'index2'])->name('universidades_salones.index2');
Route::get('universidades_salones/{nit}', [UniversidadSalonController::class, 'crear'])->name('universidades_salones.crear');
Route::delete('universidades_salones/{id}', [UniversidadSalonController::class, 'destroy'])->name('universidades_salones.destroy');

Route::post('universidades_salones', [UniversidadSalonController::class, 'store'])->name('universidades_salones.store');




// web.php
Route::get('/salones/obtener-tipos', [SalonController::class, 'obtenerTipos'])->name('salones.obtenerTipos');
Route::get('/salones/obtener-estilos/{tipo}', [SalonController::class, 'obtenerEstilos'])->name('salones.obtenerEstilos');




















