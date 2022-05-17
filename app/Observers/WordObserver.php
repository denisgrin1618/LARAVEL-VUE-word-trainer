<?php

namespace App\Observers;

use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WordObserver
{

    /**
     * Handle the Word "creating" event.
     *
     * @param  \App\Models\Word  $word
     * @return void
     */
    public function creating(Word $word) {
        $word->user_id = $word->user_id ?? Auth::user()->id;
    }


    /**
     * Handle the Word "created" event.
     *
     * @param  \App\Models\Word  $word
     * @return void
     */
    public function created(Word $word)
    {
        //
    }

    /**
     * Handle the Word "updated" event.
     *
     * @param  \App\Models\Word  $word
     * @return void
     */
    public function updated(Word $word)
    {
        //
    }

    /**
     * Handle the Word "deleted" event.
     *
     * @param  \App\Models\Word  $word
     * @return void
     */
    public function deleted(Word $word)
    {
        //
    }

    /**
     * Handle the Word "restored" event.
     *
     * @param  \App\Models\Word  $word
     * @return void
     */
    public function restored(Word $word)
    {
        //
    }

    /**
     * Handle the Word "force deleted" event.
     *
     * @param  \App\Models\Word  $word
     * @return void
     */
    public function forceDeleted(Word $word)
    {
        //
    }
}
