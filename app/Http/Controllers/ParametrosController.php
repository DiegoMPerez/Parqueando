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
use App\Http\Requests\ParametrosRequest;

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

        $i = 0;
        $j = 1;
        foreach ($horarios as $horario) {
            $horario = collect($horarios[$i]['original'] + $tarifas[$i]['attributes'] + ["numero" => $j]);
            $horarioTarifas[] = $horario;
            $i++;
            $j++;
        }

        $data = array(
            'horarios' => $horarioTarifas,
            'numero' => $count,
            'parqueadero' => $id
        );

        //dd($data);

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
        
        $horario = new Horario();
        $horario->hora_inicio = 0;
        $horario->hora_fin = 4;
        $horario->save();
        
        $precio = new Precio();
        $precio->por_hora = 0;
        $precio->semanal = 0;
        $precio->mensual = 0;
        $precio->save();
        
//Devolver los id de parqueadero y horario-tarifa
        $ht=['p_id' => 3, 'ht_id' => 5];
        
        return json_encode($ht);
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
    public function update($id,$id2, $id3, ParametrosRequest $request) {
            
        $parqueadero = Parqueadero::find($id);
        
        $horario = Horario::find($id2);
        
        $tarifa = Precio::find($id3);
        
        $hinicio = \Request::input('hinicio');
        $hfin = \Request::input('hfin');
        $xhora = \Request::input('xhora');
        $xsemana = \Request::input('xsemana');
        $xmes = \Request::input('xmes');
        
        $horario->hora_inicio = $hinicio;
        $horario->hora_fin = $hfin;
        $horario->save();
        
        $tarifa->por_hora = $xhora;
        $tarifa->semanal = $xsemana;
        $tarifa->mensual = $xmes;
        $tarifa->save();
        
        return "guardado";
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

    public function guardarHT($parqueadero, $ht) {
        
    }
    
    public function parametro() {
        
        //Buscar  el parámetro y devolver 
    }

}
