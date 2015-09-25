<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'display_name', 'description'];

    public function permisos() {
        return $this->belongsToMany('App\Permission', 'permission_role');
    }

}
