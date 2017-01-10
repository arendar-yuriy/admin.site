<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class GalleryRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['gallery-add-delete','gallery-edit']);
        return \Auth::user()->can('gallery-add-delete');
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
                    ($id !== null) ? Rule::unique('galleries')->ignore($id) : Rule::unique('galleries'),
                    'required:galleries',
                    'max:255'
                ],

                'name' => [
                    'required:galleries',
                    'max:255'
                ],
            ];
        else
            return [
                'alias_customer'=>[
                    'regex:/^[a-zа-я\d-]+$/',
                    ($id !== null) ? Rule::unique('galleries')->ignore($id) : Rule::unique('galleries'),
                    'max:255'
                ],

                'name' => [
                    'required:galleries',
                    'max:255'
                ],
            ];
    }
}
