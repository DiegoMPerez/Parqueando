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
            'altura' => 'required|numeric|regex:/^\d*(\.\d{0,2})?$/',
            'peso' => 'required|numeric|regex:/^\d*(\.\d{0,2})?$/',
            'nombre' => 'required|max:255',
            'imagen' => 'required|mimes:png|max:50',
        ];
    }

    public function messages() {
        return [
            'largo.regex' => "El formato del campo Largo es 0,00",
            'largo.numeric' => "El largo debe ser un número, utiliza el punto para separar decimales",
            'altura.regex' => "El formato del campo Altura es 0,00",
            'altura.numeric' => "La altura debe ser un número, utiliza el punto para separar decimales",
            'peso.regex' => "El formato del campo Peso es 0,00",
            'peso.numeric' => "El peso debe ser un número, utiliza el punto para separar decimales",
            'altura.required' => "La altura es requerida",
            'imagen.required' => "La imagen es requerida",
            'file'       => 'Una imagen que represente el tipo de vehículo es requerida',
            'imagen.mimes' => 'La imagen debe ser tipo png',
            'imagen.size' => 'La imagen no debe sobrepasar los 100 kb'
        ];
    }

}
