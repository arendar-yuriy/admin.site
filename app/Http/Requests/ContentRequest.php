<?php

namespace App\Http\Requests;

use App\Content;
use App\Structure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = \Route::current()->parameter('id');
        if($id !== null) return \Auth::user()->can(['content-add-delete','content-edit']);
        return \Auth::user()->can('content-add-delete');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = \Route::current()->parameter('id');

        if($id !== null){
            $content = Content::find($id);

            if($content->structures()->first()->controller == 'list')
                if ($this->get('alias_priority') == 1 )

                    return [
                        'alias_customer'=>[
                            'regex:/^[a-zа-я\d-]+$/',
                            Rule::unique('contents','alias_customer')->ignore($id),
                            'required:contents',
                            'max:255'
                        ],

                        'name' => [
                            'required:contents',
                            'max:255'
                        ]
                    ];

                else

                    return [
                        'alias_customer'=>[
                            'regex:/^[a-zа-я\d-]+$/',
                            Rule::unique('contents','alias_customer')->ignore($id),
                            'max:255'
                        ],

                        'name' => [
                            'required:contents',
                            'max:255'
                        ]
                    ];
            else
                return [
                    'name' => [
                        'required:contents',
                        'max:255'
                    ]
                ];

        }else{

            $structure = Structure::find(\Route::current()->parameter('structure_id'));

            if ($structure->controller == 'list')
                if ($this->get('alias_priority') == 1 )
                    return [
                        'alias_customer'=>[
                            'regex:/^[a-zа-я\d-]+$/',
                            Rule::unique('contents','alias_customer'),
                            'required:contents',
                            'max:255'
                        ],

                        'name' => [
                            'required:contents',
                            'max:255'
                        ]
                    ];
                else
                    return [
                        'alias_customer'=>[
                            'regex:/^[a-zа-я\d-]+$/',
                            Rule::unique('contents','alias_customer'),
                            'max:255'
                        ],

                        'name' => [
                            'required:contents',
                            'max:255'
                        ]
                    ];
            else
                return [
                    'name' => [
                        'required:contents',
                        'max:255'
                    ]
                ];
        }

    }
}
