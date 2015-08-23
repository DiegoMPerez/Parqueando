<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Parqueadero;
use Illuminate\Http\Request;

class PlazaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($nombreParqueadero) {
        $idUser = \Request::user()->id;
        $parqueaderos = User::find($idUser)->parqueaderos()->get();

        foreach ($parqueaderos as $value) {
            if ($value->nombre === $nombreParqueadero) {
                try {
                    $plazas = Parqueadero::find($value->id_parqueadero)->plazas()->get();
                    if (count($plazas) > 0) {
                        return view('plaza.plazas')->with('plazas', $plazas);
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
