<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotifySubscribersJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Article $article) {}

    public function handle(): void
    {
        //
    }
}