<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RolesRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['roles-add-delete','roles-edit']);
        return \Auth::user()->can('roles-add-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = \Route::current()->parameter('id');
        return [
            'name' => [
                'required:roles',
                ($id !== null) ? Rule::unique('roles')->ignore($id) : Rule::unique('roles'),
                'regex:/^[a-z\d\_-]+$/',
                'max:255'
            ],
            'display_name' => 'required:roles',
            'description' => 'required:roles'
        ];
    }
}
