<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Filters\WordFilter;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *    title="Word",
 *    description="Word model",
 *    @OA\Xml(
 *      name="Word"
 *    ),
 *    @OA\Property(
 *      property="name",
 *      type="string"
 *    ),
 *    @OA\Property(
 *      property="language_id",
 *      type="integer"
 *    )
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

    public function scopeWhereCurrentUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new WordFilter($request))->filter($builder);
    }
}
