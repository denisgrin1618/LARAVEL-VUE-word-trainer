<?php

namespace App\Filters;

use Illuminate\Support\Facades\Auth;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('name', $value);
    }
}