<?php

namespace App\Filters;

use Illuminate\Support\Facades\Auth;

class TranslationWordOriginNameFilter
{
    public function filter($builder, $value)
    {
        return $builder->whereHas('wordOrigin', function($q) use ($value){
            $q->where('name', $value);
        });
    }
}