<?php

use App\Horario;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |

 * 
 * 
 */



Route::get('/', 'HomeController@index');
//Route::get('/', [
//    'middleware' => ['auth','roles'],
//    'uses' => 'UserController@index',
//    'roles' => ['administrador']
//]);
//Route::resource('/', 'ParqueaderoController');



Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//PARQUEADEROS

Route::get('/parqueaderos/success', 'ParqueaderoController@success');
Route::resource('/parqueaderos', 'ParqueaderoController', ['only' => ['index', 'create', 'store', 'edit', 'destroy', 'update']]);

Route::put('/parqueaderos/activar', 'ParqueaderoController@activarParqueadero');

//PLAZAS DE ESTACIONAMIENTO

Route::put('/parqueadero/{id}/plaza/{id2}', ['as' => 'plazas', 'uses' => 'PlazaController@update']);
Route::get('/parqueadero/{id}/plazas', 'PlazaController@index');

//PARÁMETROS
Route::get('/parqueadero/{id}/parametros', 'ParametrosController@index');
Route::get('/parqueadero/parametro', 'ParametrosController@parametro');
//guardar forms generados 
Route::put('/parqueadero/{id}/parametro/guardar/{id2}', 'ParametrosController@guardarHT');
//Guardar
Route::put('/parqueadero/parametro/guardar', 'ParametrosController@store');


//USUARIOS

Route::group(['middleware' => 'roles', 'roles' => ['admin']], function() {
    Route::resource('/usuarios', 'UserController');
});

//TIPO VEHÍCULOS
//Route::resource('/tipovehiculos', 'TipoVehiculosController', ['only' => ['index', 'create', 'store', 'edit', 'destroy', 'update']]);

Route::group(['middleware' => 'roles', 'roles' => ['admin']], function() {
    Route::resource('/tipovehiculos', 'TipoVehiculosController', ['only' => ['index', 'create', 'store', 'edit', 'destroy', 'update']]);
});


//ERRORES

Route::get('/error{id}', 'ErrorController@index');


//ROLES



Route::get('/permisos/asignados', 'PermisosController@getPermisos');
Route::get('/permisos', 'PermisosController@index');

Route::put('/permisos/asignar', 'PermisosController@putAsignar');
Route::put('/permisos/designar', 'PermisosController@putDesignar');

Route::resource('/roles', 'RolesController', ['only' => ['index', 'create', 'store', 'edit', 'destroy', 'update']]);

//PERMISOS

Route::get('/permisos', 'PermisosController@index');

Route::put('/permisos/eliminar', 'PermisosController@destroy');

Route::get('/permisos/editar/{id}', 'PermisosController@edit');

Route::resource('/permisos', 'PermisosController');