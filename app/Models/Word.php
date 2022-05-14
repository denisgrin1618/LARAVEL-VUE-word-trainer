<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Filters\WordFilter;
use Illuminate\Http\Request;

/**
 * @SWG\Definition(
 *  definition="Word",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="name",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="language_id",
 *      type="integer"
 *  )
 * )
 */
class Word extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'language_id'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function language()
    {
      return $this->belongsTo(Language::class);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereCurrentUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new WordFilter($request))->filter($builder);
    }
}
