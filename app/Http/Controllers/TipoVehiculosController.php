<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoVehiculos;

class TipoVehiculosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $tvehiculos = TipoVehiculos::all();
        
        foreach ($tvehiculos as $tipo) {
            if($tipo->altura == 0){
                $tipo->altura='ilimitado';
            }else{
                $tipo->altura=$tipo->altura." m.";
            }
            
            if($tipo->peso == 0){
                $tipo->peso='ilimitado';
            }else{
                $tipo->peso=$tipo->peso.' tn.';
            }
        }
        
        return View('vehiculos.tipo_vehiculos')->with('tvehiculos', $tvehiculos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('vehiculos.crear');
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
