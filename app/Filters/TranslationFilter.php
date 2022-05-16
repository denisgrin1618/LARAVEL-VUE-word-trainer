<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class TranslationFilter extends AbstractFilter
{
    protected $filters = [
        'word_origin_name' => TranslationWordOriginNameFilter::class
    ];

}