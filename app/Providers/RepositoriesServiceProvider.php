<?php

namespace App\Providers;

use App\Repositories\TranslationRepository;
use App\Repositories\TranslationRepositoryInterface;
use App\Repositories\WordRepository;
use App\Repositories\WordRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TranslationRepositoryInterface::class, TranslationRepository::class);   
        $this->app->bind(WordRepositoryInterface::class, WordRepository::class);
    }
}
