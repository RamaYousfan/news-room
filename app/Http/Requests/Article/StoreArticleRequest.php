<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Rules\ValidArticleContent;

class StoreArticleRequest
extends FormRequest
{

    public function authorize(): bool
    {

        /** @var User|null $user */
        $user =
        Auth::user();


        return

        $user?->hasRole(

            'admin'

        )

        ||

        $user?->hasRole(

            'writer'

        );

    }



    protected function prepareForValidation()
    {

        $this->merge([

            'title'

            =>

            trim(

                ucfirst(

                    $this->title

                )

            )

        ]);

    }



    public function rules(): array
    {

        return [

            'title'=>[

                'required',

                'string',

                'min:10',

                'unique:articles,title'

            ],

            'content'=>[

                'required',

                'string',

                new ValidArticleContent

            ],

            'status'=>[

                'required',

                Rule::in([

                    'draft',

                    'published',

                    'archived'

                ])

            ],

            'tags'=>[

                'nullable',

                'array'

            ],

            'tags.*'=>[

                'exists:tags,id'

            ]

        ];

    }

}