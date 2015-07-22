<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model {

    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';

    public $timestamps = false;
    
    public function parqueaderos() {
        return $this->hasMany('App\Parqueadero');
    }

}
