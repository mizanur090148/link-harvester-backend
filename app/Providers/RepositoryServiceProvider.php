<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Repositories\DomainRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(
            DomainRepositoryInterface::class,
            DomainRepository::class
        );
    }
}
