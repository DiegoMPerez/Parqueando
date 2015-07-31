<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculos extends Model {

    protected $table = 'tipo_vehiculos';
    protected $primaryKey = 'id_tipo';
    public $timestamps = false;

}
