<?php

namespace App\Providers;

use App\Common\Document\Infrastructure\Eloquent\Specifications\Resolvers\StatusSpecificationResolver;
use App\Common\Specifications\Integration\Eloquent\CollectionSpecificationResolver;
use App\Common\Specifications\Integration\Eloquent\PaginatedSpecificationResolver;
use App\Common\Specifications\SpecificationSearch;
use Illuminate\Support\ServiceProvider;

class SpecificationServiceProvider extends ServiceProvider
{
    protected $resolvers = [
        CollectionSpecificationResolver::class,
        PaginatedSpecificationResolver::class,

        StatusSpecificationResolver::class
    ];

    /**
     * @var bool
     */
    protected $defer = true;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->afterResolving(SpecificationSearch::class, function(SpecificationSearch $search) {
            foreach ($this->resolvers as $resolver) {
                $search->registerResolver($this->app->make($resolver));
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpecificationSearch::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            SpecificationSearch::class
        ];
    }
}
