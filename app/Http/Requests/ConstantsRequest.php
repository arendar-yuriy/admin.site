<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ConstantsRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['constants-add-delete','constants-edit']);
        return \Auth::user()->can('constants-add-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = $this->get('type');

        if (in_array($type,['enumeration','multiplicity','array']))
            return [
                'name' => [
                    'required:constants',
                    Rule::unique('constants'),
                    'max:255'
                ],
                'values'=>[
                    'required:constants',
                ]
            ];

        return [
            'name' => [
                'required:constants',
                Rule::unique('constants'),
                'max:255'
            ],
        ];
    }
}
