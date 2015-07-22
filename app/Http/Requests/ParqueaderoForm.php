<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ParqueaderoForm extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
            
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
            return [
                "nombre" => "required|max:100",
                "numero" => "required|numeric|min:0|max:999",
        //        "email" => "required|email|unique:users",
                "telefono" => "required|numeric|max:9999999999|min:7",
                
            ];
	}
        public function messages()
	{
	    return [
	        "nombre.required" => "El Nombre del parqueadero es requerido",
                "nombre.max" => "El número de caracteres máximo del Nombre es 100",
                "numero.numeric" => "El número de plazas es entero",
                "numero.required" => "El Número de plazas es requerido",
                "numero.min" => "El mínimo de plazas es cero",
                "numero.max" => "El máximo de plazas es 999",
                "telefono.required" => "El número de telefono es requerido",
                "telefono.numeric" => "Solo números en el campo teléfono",
                "telefono.max" => "Máximo 10 números en el campo teléfono",
                "telefono.min" => "Mínimo 7 números en el campo teléfono",
	    ];
	}
}

