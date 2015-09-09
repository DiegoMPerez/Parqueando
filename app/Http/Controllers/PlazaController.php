<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Parqueadero;
use App\Plaza;
use Illuminate\Http\Request;
use DB;

class PlazaController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($nombreParqueadero) {
        $parqueadero = false;
        if (count(\Request::user()->parqueaderos()->get()) > 0) {
            $parqueadero = true;
        }

        $idUser = \Request::user()->id;
        $parqueaderos = User::find($idUser)->parqueaderos()->get();

        foreach ($parqueaderos as $value) {
            if ($value->nombre === $nombreParqueadero) {
                try {
                    $plazas = Parqueadero::find($value->id_parqueadero)->plazas()->get();
                    $plazas->parqueadero = $nombreParqueadero;
                    if (count($plazas) > 0) {
                        foreach ($plazas as $plaza) {
                            if ($plaza->estado === 'D') {
                                $plaza->clase = 'btn-success';
                                $plaza->value = '0';
                            }
                            if ($plaza->estado === 'O') {
                                $plaza->clase = 'btn-info';
                                $plaza->value = '1';
                            }
                            if ($plaza->estado === 'M') {
                                $plaza->clase = 'btn-warning';
                                $plaza->value = '0';
                            }
                        }
                        $data = array(
                        'parqueadero' => $parqueadero,
                        'plazas' => $plazas
                        );
                        return view('plaza.plazas')->with($data);
                    } else {
                        abort(404);
                    }
                } catch (\PDOException $ex) {
                    abort(500);
                }
            }
        }
        abort(404);
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
    public function update($id, $id2) {

        $estado_plaza = \Request::input('estado_plaza');

        try {
            $plaza = DB::table('plazas')
                            ->where('id_parqueadero', '=', $id)->
                            where('numero', '=', $id2)->get();

            if ($estado_plaza === "0") {
                $estado_plaza = 'D';
            } elseif ($estado_plaza === "1") {
                $estado_plaza = 'O';
            } elseif ($estado_plaza === "2") {
                $estado_plaza = 'M';
            } else {
                \App::abort(500);
            }
            $plazaObj = Plaza::find($plaza[0]->id_plaza);
            $plazaObj->estado = $estado_plaza;
            $plazaObj->save();
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
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
