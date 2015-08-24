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

//USUARIOS

Route::resource('/usuarios', 'UserController');

//TIPO VEHÍCULOS

Route::resource('/tipovehiculos', 'TipoVehiculosController', ['only' => ['index', 'create', 'store', 'edit', 'destroy', 'update']]);

//PLAZAS DE ESTACIONAMIENTO

Route::get('/parqueadero/{id}/plaza/{id2}', 'PlazaController@update');
Route::get('/parqueadero/{id}/plazas', 'PlazaController@index');

//ERRORES

Route::get('/error{id}', 'ErrorController@index');






