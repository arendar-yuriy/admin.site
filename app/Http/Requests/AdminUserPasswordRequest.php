<?php

namespace App\Http\Requests;

class AdminUserPasswordRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->can(['users-add-delete','roles-edit']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5'
        ];
    }
}
