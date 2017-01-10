<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['tags-add-delete','tags-edit']);
        return \Auth::user()->can('tags-add-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => [
                'required:tags',
                'max:255'
            ],
            'alias'=>[
                'regex:/^[a-zа-я\d-]+$/',
                'required:tags',
                'max:255'
            ],
            'tags*'=>[
                'regex:/^[\d]+$/'
            ]
        ];
    }
}
