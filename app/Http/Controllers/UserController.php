<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $users = User::all();
        foreach ($users as $user) {
            $rol = $user->roles()->first();
            //Control cuando las relaciones usuario - rol no existan en la base de datos
            if ($rol != null) {
                $user['rol'] = $rol;
            } else {
                $roltemp = new \App\Role();
                $roltemp['name'] = " - - - ";
                $user['rol'] = $roltemp;
            }
        }
        return View('usuarios.users')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $user = User::find($id);
        $userRole = $user->roles()->first();
        $user['rol'] = $userRole;
        return View('usuarios.edit', ['user' => $user, 'roles' => Role::all()->lists('name', 'id')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $username = \Request::input('name');
        $nombre = \Request::input('nombres');
        $apellido = \Request::input('apellidos');
        $email = \Request::input('email');
        $password = \Hash::make(\Request::input('password'));

        $user = User::find($id);
        $user->name = $username;
        $user->nombres = $nombre;
        $user->apellidos = $apellido;
        $user->email = $email;
        if (!empty(\Request::input('password'))) {
            $user->password = $password;
        }
        $user->save();

        $user->roles()->detach(); //no es necesario eliminar la relacion con el antiguo rol ya que la libreria permite tener multiples roles

        $user->attachRole(Role::find(\Request::input('rol')));

        return Redirect::route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        User::destroy($id);
        return Redirect::route('usuarios.index');
    }

}
