<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model {

    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    public $timestamps = false;

    public function direcciones() {
        return $this->hasMany('App\Direccion', 'id_direccion');
    }

}
