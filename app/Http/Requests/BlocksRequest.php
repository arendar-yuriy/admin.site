<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class BlocksRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['blocks-add-delete','blocks-edit']);
        return \Auth::user()->can('blocks-add-delete');
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
            'alias'=>[
                'regex:/^[a-zа-я\d-]+$/',
                ($id !== null) ? Rule::unique('contents')->ignore($id) : Rule::unique('contents'),
                'required:contents',
                'max:255'
            ],

            'name' => [
                'required:contents',
                'max:255'
            ]
        ];
    }
}
