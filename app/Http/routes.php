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

//
Route::resource('/parqueaderos', 'ParqueaderoController');

//USUARIOS

Route::resource('/usuarios', 'UserController');

//TIPO VEHÍCULOS

Route::resource('/tipovehiculos', 'TipoVehiculosController',['only' => ['index','create','store','edit','destroy','update']]);


//PLAZAS DE ESTACIONAMIENTO

Route::resource('/plazas', 'PlazaController');

//ERORES

Route::get('/error{id}', 'ErrorController@index');






Route::get('{any}', function($url) {
    return view('errors.404');
})->where('any', '(.*)\/$');
