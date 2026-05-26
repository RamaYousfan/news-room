<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidArticleContent
implements ValidationRule
{

    public function validate(

        string $attribute,

        mixed $value,

        Closure $fail

    ): void
    {

        if(str_word_count($value ) < 20 ){ $fail( 'Article content too short.' ); }

    }

}