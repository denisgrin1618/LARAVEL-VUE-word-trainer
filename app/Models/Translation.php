<?php

namespace App\Models;

use App\Filters\TranslationFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Translation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'word_origin_id', 'word_translation_id'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['wordOrigin', 'wordTranslation'];


    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function wordOrigin()
    {
      return $this->belongsTo(Word::class, 'word_origin_id');
    }

    public function wordTranslation()
    {
      return $this->belongsTo(Word::class, 'word_translation_id');
    }

    public function scopeWhereCurrentUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new TranslationFilter($request))->filter($builder);
    }

}
