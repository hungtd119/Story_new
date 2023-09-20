<?php

namespace App\Providers;

use App\Repositories\Audio\AudioInterface;
use App\Repositories\Audio\AudioRepository;
use App\Repositories\Auth\AuthInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Helper\HelperInterface;
use App\Repositories\Helper\HelperRepository;
use App\Repositories\Interaction\InteractionInterface;
use App\Repositories\Interaction\InteractionRepository;
use App\Repositories\Page\PageInterface;
use App\Repositories\Page\PageRepository;
use App\Repositories\Position\PositionInterface;
use App\Repositories\Position\PositionRepository;
use App\Repositories\Story\StoryInterface;
use App\Repositories\Story\StoryRepository;
use App\Repositories\Text\TextInterface;
use App\Repositories\Text\TextRepository;
use App\Repositories\Textconfig\TextconfigInterface;
use App\Repositories\Textconfig\TextconfigRepository;
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
        $this->app->bind(StoryInterface::class, StoryRepository::class);
        $this->app->bind(PageInterface::class, PageRepository::class);
        $this->app->bind(HelperInterface::class, HelperRepository::class);
        $this->app->bind(TextInterface::class, TextRepository::class);
        $this->app->bind(AudioInterface::class, AudioRepository::class);
        $this->app->bind(InteractionInterface::class, InteractionRepository::class);
        $this->app->bind(PositionInterface::class, PositionRepository::class);
        $this->app->bind(TextconfigInterface::class, TextconfigRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
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
