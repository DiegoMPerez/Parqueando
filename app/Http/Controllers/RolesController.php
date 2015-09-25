<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Http\Requests\RoleRequest;


class RolesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //Return View('role.role', array('roles' => Role::all(), 'permisos' => Permission::all()));
        
       // dd(Role::find(7)->permisos()->get());
        $data = array(
            'roles' => Role::all(),
            'permisos' => Permission::all(),
        );
        return view('role.role')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RoleRequest $roleRequest) {
        
        $nombreRol = \Request::input('name');
        $nombreRolVisual = \Request::input('visual');
        $descripcion = \Request::input('descripcion');
        
        Role::create([
            'name' => $nombreRol,
            'display_name' => $nombreRolVisual,
            'description' => $descripcion
        ]);
        
        return redirect('roles');
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

}
