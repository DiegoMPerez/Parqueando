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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'nombre' => "required|min:1|max:50|unique:roles",
            'display_name' => "required|min:1|max:50",
            'description' => "required|max:200"
        ];
    }

}
