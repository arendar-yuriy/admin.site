<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AdminUserRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['users-add-delete','roles-edit']);
        return \Auth::user()->can('users-add-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = \Route::current()->parameter('id');
        if ($id !== null)
            return [
                'email' => [
                    'required:admin_users',
                    Rule::unique('admin_users')->ignore($id),
                    'email',
                    'max:255'
                ],
                'roles' => [
                    'required',
                ],
                'name' => [
                    'required:admin_users',
                    'max:255'
                ],
            ];
        else
            return [
                'email' => [
                    'required:admin_users',
                    Rule::unique('admin_users'),
                    'email',
                    'max:255'
                ],
                'roles' => [
                    'required',
                ],
                'name' => [
                    'required:admin_users',
                    'max:255'
                ],
                'password' => 'required|min:5|confirmed',
                'password_confirmation' => 'required|min:5'
            ];
    }
}
