<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use App\Observers\ArticleObserver;
use App\Repositories\AttachmentRepository;
use App\Repositories\Contracts\AttachmentRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
$this->app->bind(
    AttachmentRepositoryInterface::class,
    AttachmentRepository::class
);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Model Observers
        Article::observe(ArticleObserver::class);
    }
}