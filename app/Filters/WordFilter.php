<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class WordFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'language_id' => LanguageIdFilter::class
    ];

}