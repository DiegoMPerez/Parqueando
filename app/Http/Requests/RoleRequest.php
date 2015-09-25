<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => "required|max:50|unique:roles",
            'visual' => "required|max:50",
            'descripcion' => "required|max:200"
        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'El nombre del Rol es requerido',
            'name.max' => 'Máximo 50 caracteres en el nombre del Rol',
            'name.unique' => 'Este rol ya existe',
            'visual.required' => 'El nombre visual es requerido',
            'visual.max' => 'Máximo 50 caracteres para el nombre visual del Rol',
            'descripcion.required' => 'La descripción del Rol es requerida',
            'descripcion.max' => 'Máximo 200 caracteres en la descripción del Rol',

        ];
    }

}
