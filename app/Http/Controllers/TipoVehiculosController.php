<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTipoVehiculos;
use App\TipoVehiculos;
use DB;
use Intervention\Image\Facades\Image;

class TipoVehiculosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $tvehiculos = TipoVehiculos::all();

        foreach ($tvehiculos as $tipo) {
            if ($tipo->altura == 0) {
                $tipo->altura = 'ilimitado';
            } else {
                $tipo->altura = $tipo->altura . " m.";
            }

            if ($tipo->peso == 0) {
                $tipo->peso = 'ilimitado';
            } else {
                $tipo->peso = $tipo->peso . ' tn.';
            }
            try{
            $img = Image::make(storage_path('imagenes/tv_12.png'));
            $img->fit(20, 20);
            $tipo->imagen = $img->response('png');
            }  catch (Exception $r){
                
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
    public function store(RequestTipoVehiculos $request) {
        try {
            $destinationPath = base_path('storage/imagenes');
            //Extensión del file
            $extension = \Request::file('imagen')->getClientOriginalExtension();
            //id para el nombre de la imagen
            $results = DB::table('tipo_vehiculos')->max('id_tipo');
            //renombrando la imagen
            \Request::file('imagen')->move($destinationPath, 'tv_' . $results . '.' . $extension);
        } catch (Exception $ex) {
            dd($ex);
        }

        return redirect('tipovehiculos/create');
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
