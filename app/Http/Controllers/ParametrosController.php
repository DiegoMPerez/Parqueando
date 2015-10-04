<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parqueadero;
use App\Tarifa_Horario;
use App\Horario;
use App\Precio;
use Illuminate\Support\Collection;

class ParametrosController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id) {

        $horarios = Parqueadero::find(55)->horarios()->get();
        $tarifas = Parqueadero::find(55)->tarifas()->get();
        $count = $tarifas->count();
        
        $horarioTarifas = collect();

        $i=0;
        $j=1;
        foreach ($horarios as $horario) {
            $horario=  collect($horarios[$i]['original'] + $tarifas[$i]['attributes'] + ["numero"=>$j]);
            $horarioTarifas[] = $horario;
            $i++;
            $j++;
        }
        
        $data = array(
            'horarios' => $horarioTarifas,
            'numero' => $count
        );

       //dd($horarioTarifas);

        return view('parqueadero.parametros.parametros')->with($data);
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
        return "ok";
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
