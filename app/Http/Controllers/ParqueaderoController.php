<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParqueaderoForm;
use App\Parqueadero;
use App\Ciudad;
use App\Horario;

class ParqueaderoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        dd(Parqueadero::find(1)->precios()->first());
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
        $ciudad = new \App\Ciudad;
        $ciudad->nombre_ciudad = \Request::input('numero');
        $ciudad->save();
        return redirect('parqueaderos/create')->with('message', 'Parqueadero guardado');
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
