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
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
                    "numero" => "required",
		];
	}
        public function messages()
	{
	    return [
	        'numero.required' => 'El campo title es requerido!',
                'numero.min' => 'Mínimo 0!',
	    ];
	}

}
