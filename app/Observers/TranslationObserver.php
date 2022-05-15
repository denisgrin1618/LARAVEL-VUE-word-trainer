<?php

namespace App\Observers;

use App\Models\Translation;
use Illuminate\Support\Facades\Auth;

class TranslationObserver
{
    /**
     * Handle the Translation "creating" event.
     *
     * @param  \App\Models\Translation  $translation
     * @return void
     */
    public function creating(Translation $translation) {
        $translation->user_id = Auth::user()->id;
    }
}
