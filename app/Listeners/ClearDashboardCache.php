<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use Illuminate\Support\Facades\Cache;

class ClearDashboardCache
{
    public function handle(ArticleUpdated $event): void
    {
        Cache::tags(['dashboard'])->flush();
    }
}