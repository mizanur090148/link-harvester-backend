<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Repositories\CategoryRepository;
// use App\Repositories\Interfaces\CategoryRepositoryInterface;
// use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
// use App\Repositories\SubCategoryRepository;
// use App\Repositories\Interfaces\CompanyRepositoryInterface;
// use App\Repositories\BranchRepository;
// use App\Repositories\Interfaces\BranchRepositoryInterface;
// use App\Repositories\AccountRepository;
// use App\Repositories\Interfaces\AccountRepositoryInterface;
// use App\Repositories\CompanyRepository;
// use App\Repositories\Interfaces\ChartOfAccountRepositoryInterface;
// use App\Repositories\ChartOfAccountRepository;
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
