<?php

namespace App\Providers;

use App\Repositories\Contracts\BankAccountRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface as ContractsCustomerRepositoryInterface;
use App\Repositories\Eloquent\EloquentBankAccountRepository;
use App\Repositories\Eloquent\EloquentCustomerRepository as EloquentEloquentCustomerRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\ComponentNotificate;


use CustomerRepositoryInterface;
use EloquentCustomerRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ContractsCustomerRepositoryInterface::class, EloquentEloquentCustomerRepository::class);
        $this->app->bind(BankAccountRepositoryInterface::class, EloquentBankAccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('component-notificate', ComponentNotificate::class);
    }
}