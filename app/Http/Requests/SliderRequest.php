<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['sliders-add-delete','sliders-edit']);
        return \Auth::user()->can('sliders-add-delete');
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
                ($id !== null) ? Rule::unique('sliders')->ignore($id) : Rule::unique('sliders'),
                'max:255'
            ],
            'name' => [
                'required:sliders',
                'max:255'
            ]
        ];
    }
}
