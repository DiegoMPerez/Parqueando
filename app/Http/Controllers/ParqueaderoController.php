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
use App\Plaza;

class ParqueaderoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        if (!\Request::user()) {
            abort(403);
        }
        
        $idUser = \Request::user()->id;

        $parqueaderos = User::find($idUser)->parqueaderos()->get();
        
        $data = array(
            'parqueaderos' => $parqueaderos,
            'ruta' => "parqueaderos"
        );

        return view("parqueadero.parqueaderos")->with($data);
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
        if (!\Request::user()) {
            abort(403);
        }

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

            $numero_plazas = \Request::input('numero');

            $parqueadero = \App\Parqueadero::create([
                        'id_usuario' => \Request::user()->id,
                        'nombre' => \Request::input('nombre'),
                        'numero_plazas' => $numero_plazas,
                        'telefono' => \Request::input('telefono'),
                        'ubicacion_geografica' => DB::raw("POINT(" . \Request::input('lat') . "," . \Request::input('lng') . ")"),
                        'id_direccion' => $direcciones->getKey('id_direccion')
            ]);

            //Creación de las plazas
            for ($i = 1; $i <= $numero_plazas; $i++) {
                $plaza = new Plaza();
                $plaza->id_parqueadero = $parqueadero->getKey("id_parqueadero");
                $plaza->numero = $i;
                $plaza->save();
            }

            \DB::commit();

            $ruta = 'parqueaderos/create';
            return view('errors/202')->with('ruta', $ruta);
        } catch (\PDOException $ex) {
            abort(500, 'Unauthorized action.');
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
        $ruta = 'parqueaderos';
        return view('errors/202')->with('ruta', $ruta);
    }
    
    public function activarParqueadero(){
        
        return "ok";
    }

}
