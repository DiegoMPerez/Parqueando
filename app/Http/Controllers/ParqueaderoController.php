<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParqueaderoForm;
use App\Parqueadero;
use App\Ciudad;
use App\Horario;
use App\Pais;
use App\Direccion;
use App\Role;
use App\Http\Controllers\Auth;
use DB;

class ParqueaderoController extends Controller {

    public function __construct() {
        // $this->middleware('roles');
        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('parqueadero.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ParqueaderoForm $parqueaderoForm) {


        try {

            $ciudad = \App\Ciudad::firstOrCreate([
                        'nombre_ciudad' => \Request::input('ciudad')
            ]);

            $pais = \App\Pais::firstOrCreate([
                        'nombre_pais' => \Request::input('pais')
            ]);

            $direcciones = \App\Direccion::firstOrCreate([
                        'direccion' => \Request::input('direccion'),
                        'id_pais' => $pais->getKey('id_pais'),
                        'id_ciudad' => $ciudad->getKey('id_ciudad')
            ]);

            $parqueadero = \App\Parqueadero::create([
                        'nombre' => \Request::input('nombre'),
                        'numero_plazas' => \Request::input('numero'),
                        'telefono' => \Request::input('telefono'),
                        'ubicacion_geografica' => DB::raw("POINT(" . \Request::input('lat') . "," . \Request::input('lng') . ")"),
                        'id_direccion' => $direcciones->getKey('id_direccion')
            ]);
            $ruta = 'parqueaderos/create';
            return view('errors/202')->with('ruta', $ruta);
        } catch (\PDOException $ex) {
            throwException($exception);
            //return view('errors/500');
            
        }
        
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

    public function success() {
        $ruta = 'parqueaderos/create';
        return view('errors/202')->with('ruta', $ruta);
    }

}
