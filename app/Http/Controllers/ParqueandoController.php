<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;

class ParqueandoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return view('parqueando.parqueando');
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

    public function parqueaderos($id) {
        $kilometros = 2;
        $distancia = $kilometros * 0.621371;

        //Algoritmo Vincenty para el cálculo de distancia en un área de un elipsoide

        $parqueaderos = DB::select("SELECT  id_parqueadero,nombre,estado,X(ubicacion_geografica) as x, Y(ubicacion_geografica) as y, distance FROM (
    SELECT id_parqueadero,nombre,estado,    ubicacion_geografica,r,
           units * DEGREES(
              ATAN2(
                SQRT(
                   POW(COS(RADIANS(latpoint))*SIN(RADIANS(longpoint-Y(ubicacion_geografica))),2) +
                     POW(COS(RADIANS(X(ubicacion_geografica)))*SIN(RADIANS(latpoint)) -
                     (SIN(RADIANS(X(ubicacion_geografica)))*COS(RADIANS(latpoint)) *
                      COS(RADIANS(longpoint-Y(ubicacion_geografica)))) ,2)),
                   SIN(RADIANS(X(ubicacion_geografica)))*SIN(RADIANS(latpoint)) +
                     COS(RADIANS(X(ubicacion_geografica)))*
                     COS(RADIANS(latpoint))*
                     COS(RADIANS(longpoint-Y(ubicacion_geografica)
                   )
                  ))) AS distance
      FROM parqueaderos
      JOIN (
             SELECT 0.31941791742451  AS latpoint,  -78.106955485181 AS longpoint,
             " . $distancia . " AS r, 69.0 AS units
           ) AS p ON (1=1)
     WHERE MBRCONTAINS(GEOMFROMTEXT(
             CONCAT('LINESTRING(',
                       latpoint-(r/units),' ',
                       longpoint-(r /(units* COS(RADIANS(latpoint)))),
                       ',',
                       latpoint+(r/units) ,' ',
                       longpoint+(r /(units * COS(RADIANS(latpoint)))),
                    ')')),  ubicacion_geografica)
       ) AS d
 WHERE distance <= r
 ORDER BY distance");




        // Área plana, algoritmo de Euclides
//        "SELECT X(ubicacion_geografica), Y(ubicacion_geografica), distance 
//  FROM ( 
//         SELECT ubicacion_geografica,r, 
//                units * DEGREES( ACOS( COS(RADIANS(latpoint)) * 
//                                       COS(RADIANS(X(ubicacion_geografica))) * 
//                                       COS(RADIANS(longpoint) - RADIANS(Y(ubicacion_geografica))) + 
//                                       SIN(RADIANS(latpoint)) * 
//                                       SIN(RADIANS(X(ubicacion_geografica))))) AS distance 
//           FROM parqueaderos
//           JOIN ( 
//                  SELECT 0.3190746 AS latpoint, -78.1075563 AS longpoint, 
//                         10.0 AS r, 69.0 AS units 
//                ) AS p ON (1=1) 
//          WHERE MbrContains(GeomFromText( 
//                        CONCAT('LINESTRING(', latpoint-(r/units),' ',
//                                              longpoint-(r /(units* COS(RADIANS(latpoint)))), 
//                                              ',', 
//                                              latpoint+(r/units) ,' ', 
//                                              longpoint+(r /(units * COS(RADIANS(latpoint)))), ')')),
//                        ubicacion_geografica) 
//       ) AS d 
// WHERE distance <= r 
// ORDER BY distance"

        foreach ($parqueaderos as $p) {

            $distancia_metros = $p->distance * 1609.34;
            //Distancia menor a un metro es 0
            if ($distancia_metros < 1) {
                $p->distance = 0;
            } else {
                $p->distance = $p->distance * 1609.34;
            }
        }

        $data = array(
            'parq' => $parqueaderos
        );

        $encode = json_encode($data);
    }
}