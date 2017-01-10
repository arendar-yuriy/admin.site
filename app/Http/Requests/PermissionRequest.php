<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PermissionRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['permissions-add-delete','permissions-edit']);
        return \Auth::user()->can('permissions-add-delete');
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
                'required:permissions',
                ($id !== null) ? Rule::unique('permissions')->ignore($id) : Rule::unique('permissions'),
                'regex:/^[a-z\d\_-]+$/',
                'max:255'
            ],
            'display_name' => 'required:permissions',
            'description' => 'required:permissions'
        ];
    }
}
