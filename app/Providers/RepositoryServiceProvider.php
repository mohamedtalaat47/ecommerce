<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BrandContract;
use App\Repositories\BrandRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    // protected $repositories = [
    //     CategoryContract::class         =>          CategoryRepository::class,
    //     AttributeContract::class        =>          AttributeRepository::class,
    //     BrandContract::class            =>          BrandRepository::class,
    // ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BrandContract::class,
            BrandRepository::class
        );

        $this->app->bind(
            AttributeContract::class,
            AttributeRepository::class
        );
        
        $this->app->bind(
            CategoryContract::class,
            CategoryRepository::class
        );
    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
