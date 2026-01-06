<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/**
 * Rutas del Sistema de Inventario
 * 
 * GET  /              - Muestra la lista de productos
 * POST /productos     - Guarda un nuevo producto
 * PUT  /productos/{id} - Actualiza un producto existente
 * DELETE /productos/{id} - Elimina un producto
 */
Route::get('/', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
Route::put('/productos/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

