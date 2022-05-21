<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\Translation;
use App\Models\Word;
use App\Observers\MessageObserver;
use App\Observers\TranslationObserver;
use App\Observers\WordObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Word::observe(WordObserver::class);
        Translation::observe(TranslationObserver::class);
        Message::observe(MessageObserver::class);
    }
}
