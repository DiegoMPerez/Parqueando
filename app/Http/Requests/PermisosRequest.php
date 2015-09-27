<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PermisosRequest extends Request {

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
            'display_name' => "required|max:50",
            'description' => "required|max:200"
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El nombre del Permiso es requerido',
            'name.max' => 'Máximo 50 caracteres en el nombre del Permiso',
            'name.unique' => 'Este permiso ya existe',
            'display_name.required' => 'El nombre visual es requerido',
            'display_name.max' => 'Máximo 50 caracteres para el nombre visual del Permiso',
            'description.required' => 'La descripción del Permiso es requerida',
            'description.max' => 'Máximo 200 caracteres en la descripción del Permiso',
        ];
    }

}
