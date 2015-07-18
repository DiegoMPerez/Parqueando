<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RolesSeeder extends Seeder {

    public function run() {
        DB::table('roles')->delete();
        $admin = Role::create(array(
                    'name' => 'admin'
        ));

        $permisos = Permission::all();
        foreach ($permisos as $permiso) {
            $admin->attachPermission($permiso);
        }
    }

}
