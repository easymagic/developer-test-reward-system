<?php

namespace App\Providers;

use App\Interfaces\AchievementInterface;
use App\Interfaces\UserActivityInterface;
use App\Repositories\AchievementRepository;
use App\Repositories\UserActivityRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        app()->bind(UserActivityInterface::class,UserActivityRepository::class);
        app()->bind(AchievementInterface::class,AchievementRepository::class);
    }
}
