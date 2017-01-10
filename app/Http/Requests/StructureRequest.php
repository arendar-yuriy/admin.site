<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StructureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['structure-add-delete','structure-edit']);
        return \Auth::user()->can('structure-add-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = \Route::current()->parameter('id');
        if ($this->get('alias_priority') == 1 )
            return [
                'alias_customer'=>[
                    'regex:/^[a-zа-я\d-]+$/',
                    'required:structures',
                    ($id !== null) ? Rule::unique('structures')->ignore($id) : Rule::unique('structures'),
                    'max:255'
                ],

                'name' => [
                    'required:structures',
                    'max:255'
                ],
            ];
        else
            return [
                'alias_customer'=>[
                    'regex:/^[a-zа-я\d-]+$/',
                    ($id !== null) ? Rule::unique('structures')->ignore($id) : Rule::unique('structures'),
                    'max:255'
                ],

                'name' => [
                    'required:structures',
                    'max:255'
                ],
            ];

    }

}
