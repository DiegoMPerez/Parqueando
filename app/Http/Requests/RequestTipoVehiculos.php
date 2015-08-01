<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequestTipoVehiculos extends Request {

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
            'nombre' => 'required|min:2|max:50',
            'largo' => 'required|numeric|regex:/^\d*(\.\d{0,2})?$/',
            'file' => 'required'
        ];
    }

    public function messages() {
        return [
            'largo.regex' => "El formato del campo Largo es 0,00",
        ];
    }

}
