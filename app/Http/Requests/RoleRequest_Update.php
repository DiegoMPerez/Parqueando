<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleRequest_Update extends Request {

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
            'name' => "required|max:50",
            'display_name' => "required|max:50",
            'description' => "required|max:200"
        ];
    }
    
    public function messages() {
        return [
            'name.required' => 'El nombre del Rol es requerido',
            'name.max' => 'Máximo 50 caracteres en el nombre del Rol',
            'display_name.required' => 'El nombre visual es requerido',
            'display_name.max' => 'Máximo 50 caracteres para el nombre visual del Rol',
            'description.required' => 'La descripción del Rol es requerida',
            'description.max' => 'Máximo 200 caracteres en la descripción del Rol',

        ];
    }

}
