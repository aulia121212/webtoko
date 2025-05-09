<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Transactions\TransactionManager;
use Maatwebsite\Excel\Transactions\NullTransactionManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(TransactionManager::class, function () {
        //     return new NullTransactionManager();
        // });    
        }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}