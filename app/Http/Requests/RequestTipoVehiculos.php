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

        
        $rules = array(
            'file' => 'required|min:1|integerOrArray'
        );

        return $rules;
    }

    public function messages() {
        return [
            'largo.regex' => "El formato del campo Largo es 0,00",
        ];
    }

}
