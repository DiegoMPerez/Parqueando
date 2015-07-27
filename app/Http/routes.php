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



Route::resource('/error','ErrorController');
