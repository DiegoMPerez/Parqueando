<?php

namespace App\Services;

use App\User;
use App\Role;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'nombres' => 'required|max:255',
                    'apellidos' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data) {

        $user = User::create([
            'name' => $data['name'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->attachRole(Role::find(100));
        return $user;
    }

}
