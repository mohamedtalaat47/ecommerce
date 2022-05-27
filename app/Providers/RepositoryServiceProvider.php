<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BrandContract;
use App\Repositories\BrandRepository;
use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;
use App\Contracts\AttributeContract;
use App\Repositories\AttributeRepository;
use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;
use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;

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
