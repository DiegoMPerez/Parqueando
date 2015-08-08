<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTipoVehiculosEditar;
use App\Http\Requests\RequestTipoVehiculos;
use App\TipoVehiculos;
use Illuminate\Support\Facades\Redirect;
use DB;

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

            if ($tipo->largo == 0) {
                $tipo->largo = 'ilimitado';
            } else {
                $tipo->largo = $tipo->largo . " m.";
            }

            if ($tipo->peso == 0) {
                $tipo->peso = 'ilimitado';
            } else {
                $tipo->peso = $tipo->peso . ' tn.';
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

        $destinationPath = public_path('imagenes');
        //Extensión del file
        $extension = \Request::file('imagen')->getClientOriginalExtension();
        //id para el nombre de la imagen
        $results = DB::table('tipo_vehiculos')->max('id_tipo');
        //renombrando la imagen
        \Request::file('imagen')->move($destinationPath, 'tv_' . $results . '.' . $extension);

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
        $tipovehiculo = TipoVehiculos::find($id);
        return View('vehiculos.editar', ['tipovehiculo' => $tipovehiculo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(RequestTipoVehiculosEditar $request) {

        $nombre = \Request::input('nombre');
        $largo = \Request::input('largo');
        $altura = \Request::input('altura');
        $peso = \Request::input('peso');
        $descripcion = \Request::input('descripcion');
        $imagen = \Request::file('imagen');

        $id = \Request::input('id');
        $tipo = TipoVehiculos::find($id);



        $tipo->nombre = $nombre;
        $tipo->largo = $largo;
        $tipo->altura = $altura;
        $tipo->peso = $peso;
        $tipo->descripcion = $descripcion;


        if ($imagen !== null) {
            $destinationPath = public_path('imagenes');
            //Extensión del file
            $extension = \Request::file('imagen')->getClientOriginalExtension();
            //renombrando la imagen
            $nombre_img = 'tv_' . $id . '.' . $extension;
            \Request::file('imagen')->move($destinationPath, $nombre_img);
            $tipo->imagen = $nombre_img;
        }

        $tipo->save();

        return Redirect::route('tipovehiculos.index');
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
