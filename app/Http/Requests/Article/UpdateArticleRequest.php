<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidArticleContent;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin') || auth()->user()?->hasRole('writer');
    }

    protected function prepareForValidation()
    {
        if ($this->has('title')) {
            $this->merge([
                'title' => trim(ucfirst($this->title))
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'string',
                'min:10',
                Rule::unique('articles', 'title')
                    ->ignore($this->route('article'))
            ],

            'content' => [
                'sometimes',
                'string',
                new ValidArticleContent
            ],

            'status' => [
                'sometimes',
                Rule::in(['draft', 'published', 'archived'])
            ],

            'tags' => ['sometimes', 'array'],
            'tags.*' => ['exists:tags,id']
        ];
    }
}