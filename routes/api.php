<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/proyecto/listar','ProyectoController@Listar');
Route::get('/proyecto/buscar/{id}','ProyectoController@Buscar');

Route::post('/proyecto/crear','ProyectoController@Crear');
Route::post('/proyecto/eliminar','ProyectoController@Eliminar');
Route::post('/proyecto/actualizar','ProyectoController@Actualizar');

Route::get('/integrante/listar','IntegranteController@Listar');
Route::get('/integrante/buscar/{id}','IntegranteController@Buscar');

Route::post('/integrante/crear','IntegranteController@Crear');
Route::post('/integrante/asignar/proyecto','IntegranteController@AsignarIntegrante');
