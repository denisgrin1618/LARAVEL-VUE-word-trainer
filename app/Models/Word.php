<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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


    // protected static function boot()
    // {
    //     parent::boot();

    //     // auto-sets values on creation
    //     static::creating(function ($query) {
    //         $query->user_id= Auth::user()->id;
    //     });
    // }
}
