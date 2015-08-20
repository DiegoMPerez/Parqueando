<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model {

    protected $table = 'paises';
    protected $primaryKey = 'id_pais';
    protected $fillable = ['nombre_pais'];
    public $timestamps = false;

    public function direcciones() {
        return $this->hasMany('App\Direccion', 'id_pais');
    }

}
