<?php

namespace App\Providers;

use App\Models\Currencies\Crypto;
use Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Route;
use Str;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            $view->with([
                'user' => auth()->user(),
            ]);
        });

        Route::bind('crypto', function ($crypto) {
            return Crypto::whereName($crypto)->firstOrFail();
        });

        Paginator::useBootstrap();

        Request::macro('isSubDomain', function ($domain = null) {

            $hostArr =  explode('.', $this->getHost());

            if (count($hostArr) > 2) {
                // uses sub domain

                if (is_null($domain)) {

                    return true;
                }

                if ($hostArr[0] == $domain) {

                    return true;
                }
            }

            return false;
        });

        Builder::macro('searchWhereHas', function ($query, $attr, $searchQuery) {

            $attrArr = explode('.', $attr);

            $relation = $attrArr[0];

            $relationAttr = $attrArr[1];

            return $query->orWhereHas($relation, function (Builder $query) use ($relationAttr, $searchQuery, $attrArr, $relation) {

                if (isset($attrArr[2])) {

                    $relation = $attrArr[1];
                    $relationAttr = $attrArr[2];

                    return $query->whereHas($relation, function ($query) use ($searchQuery, $relationAttr) {

                        $query->Where($relationAttr, 'Like', $searchQuery);
                    });
                }

                return $query->Where($relationAttr, 'Like', $searchQuery);
            });
        });

        Builder::macro('searchLike', function ($attributes, $searchQuery) {
            foreach (Arr::wrap($attributes) as $attr) {
                $this->when(
                    Str::contains($attr, '.'),
                    // is relation
                    function (Builder $query) use ($attr, $searchQuery) {

                        $query = $this->searchWhereHas($query, $attr, "%{$searchQuery}%");
                    },
                    // is single attr
                    function (Builder $query) use ($attr, $searchQuery) {

                        $query->orWhere($attr, 'Like', "%{$searchQuery}%");
                    }
                );
            }

            return $this;
        });
    }
}
