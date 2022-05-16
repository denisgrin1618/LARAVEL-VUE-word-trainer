<?php

namespace App\Filters;

use Illuminate\Support\Facades\Auth;

class LanguageIdFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('language_id', $value);
    }
}