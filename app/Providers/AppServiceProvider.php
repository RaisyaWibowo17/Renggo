<?php

namespace App\Providers;

use App\Models\Favorite;
use App\Models\Promo;
use App\Models\Review;
use App\Models\Umkm;
use App\Policies\PromoPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\UmkmPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Umkm::class, UmkmPolicy::class);
        Gate::policy(Review::class, ReviewPolicy::class);
        Gate::policy(Promo::class, PromoPolicy::class);

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
