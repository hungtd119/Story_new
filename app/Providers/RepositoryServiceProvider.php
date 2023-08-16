<?php

namespace App\Providers;

use App\Repositories\Audio\AudioInterface;
use App\Repositories\Audio\AudioRepository;
use App\Repositories\Helper\HelperInterface;
use App\Repositories\Helper\HelperRepository;
use App\Repositories\Page\PageInterface;
use App\Repositories\Page\PageRepository;
use App\Repositories\Story\StoryInterface;
use App\Repositories\Story\StoryRepository;
use App\Repositories\Text\TextInterface;
use App\Repositories\Text\TextRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoryInterface::class,StoryRepository::class);
        $this->app->bind(PageInterface::class,PageRepository::class);
        $this->app->bind(HelperInterface::class,HelperRepository::class);
        $this->app->bind(TextInterface::class,TextRepository::class);
        $this->app->bind(AudioInterface::class,AudioRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
