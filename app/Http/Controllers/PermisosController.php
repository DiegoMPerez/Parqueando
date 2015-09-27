<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class PermisosController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $permisos = Permission::all();
        return view('permisos.permisos')->with('permisos', $permisos);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function getPermisos() {

        $id_rol = \Request::input('rol_id');
        $permisosDeRol = Role::find($id_rol);
        if (empty($permisosDeRol)) {
            abort(404);
        }

        $p = array();

        $permisos = Permission::all();

        $p['permisos_a'] = $permisosDeRol->permisos()->get();

        $temp = array();

        for ($i = 0; $i < count($permisos); $i++) {
            for ($j = 0; $j < count($p['permisos_a']); $j++) {
                if ($permisos[$i]->name !== $p['permisos_a'][$j]->name) {
                    $temp[] = $permisos[$i];
                    break;
                }
            }
        }

        $p['permisos'] = $temp;
        if (empty($temp)) {
            $p['permisos'] = $permisos;
        }

        return $p;
    }

    public function putAsignar() {

        $id_rol = \Request::input('rol_id');
        $permisos = \Request::input('permisos');

        $rol = Role::find($id_rol);
        $permisos_a = $rol->permisos()->get();


        for ($i = 0; $i < count($permisos); $i++) {
            for ($j = 0; $j < count($permisos_a); $j++) {
                if ($permisos[$i] == $permisos_a[$j]->id) {
                    $permisos[$i] = null;
                }
            }
        }

        foreach ($permisos as $permiso) {
            if ($permiso != null) {
                $rol->attachPermission($permiso);
            }
        }

        return $permisos;
    }

    public function putDesignar() {

        $id_rol = \Request::input('rol_id');
        $permisos = \Request::input('permisos');

        $rol = Role::find($id_rol);
        $permisos_a = $rol->permisos()->get();


        for ($i = 0; $i < count($permisos); $i++) {
            for ($j = 0; $j < count($permisos_a); $j++) {
                if ($permisos[$i] == $permisos_a[$j]->id) {
                    $permisos_a[$j]->id = 0;
                }
            }
        }


        foreach ($permisos_a as $permiso) {
            if ($permiso->id !== 0) {
                $rol->detachPermission($permiso->id);
            }
        }
        return $permisos_a;
    }
}
