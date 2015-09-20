<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function permisos() {
        return $this->belongsToMany('App\Permission', 'permission_role');
    }

}
