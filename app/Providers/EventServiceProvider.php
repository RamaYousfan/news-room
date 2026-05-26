<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\ArticlePublished;
use App\Events\ArticleUpdated;
use App\Events\UserRegistered;

use App\Listeners\SendArticleNotification;
use App\Listeners\ClearDashboardCache;
use App\Listeners\SendWelcomeEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        ArticlePublished::class => [
            SendArticleNotification::class,
        ],

        ArticleUpdated::class => [
            ClearDashboardCache::class,
        ],

        UserRegistered::class => [
            SendWelcomeEmail::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}