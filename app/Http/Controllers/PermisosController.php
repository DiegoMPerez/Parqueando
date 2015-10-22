<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PermisosRequest;
use App\Http\Requests\PermisosRequest_Update;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use Validator;
use Response;

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
        
        $permisos = Permission::all();
        
        $data = array(
            'permisos' => $permisos,
            'ruta' => 'permisos'
        );
        
        return view('permisos.permisos')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PermisosRequest $request) {

        $nombrePermiso = \Request::input('name');
        $nombrePermisoVisual = \Request::input('display_name');
        $descripcion = \Request::input('description');

        Permission::create([
            'name' => $nombrePermiso,
            'display_name' => $nombrePermisoVisual,
            'description' => $descripcion
        ]);

        return redirect('permisos');
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
        try {
            $permiso = Permission::find($id);
            return view('permisos.edit')->with('permiso', $permiso);
        } catch (\PDOException $exc) {
            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PermisosRequest_Update $permisoRequest) {
        $permisoReal = Permission::find($id);

        $permisoName = \Request::input('name');
        $permisoVisual = \Request::input('display_name');
        $permisoDescripcion = \Request::input('description');
        $permisoReal->display_name = $permisoVisual;
        $permisoReal->description = $permisoDescripcion;



        if ($permisoReal->name !== $permisoName) {
            $validator = Validator::make($permisoRequest->all(), [
                        'name' => 'unique:permissions'], [ 'name.unique' => 'El permiso ya existe'
            ]);

            if ($validator->fails()) {
                return Response::json($validator->messages(), 422);
            }
        }

        $permisoReal->name = $permisoName;
        $permisoReal->save();

        return view('permisos.permisos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy() {

        $idPermiso = \Request::input('permiso_id');
        Permission::destroy($idPermiso);
        return json_encode("asd");
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
