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
use DB;

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
        $parqueadero = DB::table('parqueaderos')->where('nombre', '=', $id)->get();
        $id_parqueadero = $parqueadero[0]->id_parqueadero;
        $horarios = Parqueadero::find($id_parqueadero)->horarios()->get();
        $tarifas = Parqueadero::find($id_parqueadero)->tarifas()->get();
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

        $id_parqueadero = \Request::input('parqueadero');
        $parqueadero = DB::table('parqueaderos')->where('nombre', '=', $id_parqueadero)->get();

        $horario = new Horario();
        $horario->hora_inicio = '00:00';
        $horario->hora_fin = '00:00';
        $horario->save();

        $precio = new Precio();
        $precio->por_hora = 0.00;
        $precio->semanal = 0.00;
        $precio->mensual = 0.00;
        $precio->save();

//Devolver los id de parqueadero y horario-tarifa

        $ht = new Tarifa_Horario();
        $ht->id_horario = $horario->id_horario;
        $ht->id_tarifa = $precio->id_tarifa;
        $ht->id_parqueadero = $parqueadero[0]->id_parqueadero;
        $ht->save();

        $h_t = ['p_id' => $ht->id_parqueadero, 'ht_id' => $ht->id];

        return json_encode($h_t);
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
    public function update($id, $id2, $id3, ParametrosRequest $request) {

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

        return json_encode('GUARDADO');
    }

    /**

     *      * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $id2, $id3) {
        $parqueadero = Parqueadero::find($id);
        if (!empty($parqueadero)) {
            $h_t = DB::table('tarifa_horario')->where('id_horario', '=', $id2)->where('id_tarifa', '=', $id3)->get();
            Tarifa_Horario::destroy($h_t[0]->id);
            Horario::destroy($id2);
            Precio::destroy($id3);
            return json_encode("eliminado");
        }
        return json_encode("fallo");
    }

    public function parametro() {
        $id_parqueadero = \Request::input('parqueadero');
        $id_horarioTarifa = \Request::input('ht');
        $parqueadero = Parqueadero::find($id_parqueadero);
        $ht = DB::table('tarifa_horario')->where('id', '=', $id_horarioTarifa)->get();

        $horario = Horario::find($ht[0]->id_horario);
        $tarifa = Precio::find($ht[0]->id_tarifa);
        $horario_tarifa = collect($horario['original'] + $tarifa['attributes'] + ["id_parqueadero" => $parqueadero->id_parqueadero]);

        return array($horario_tarifa);
    }

}
