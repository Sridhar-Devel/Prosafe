<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
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
        Filament::serving(function () {
            Filament::registerNavigationGroups([

                NavigationGroup::make()
                    ->label('Documents')
                    ->collapsed(true),

                NavigationGroup::make()
                    ->label('Customer Management')
                    ->collapsed(true),

                NavigationGroup::make()
                    ->label('Locker Management')
                    ->collapsed(true),

                NavigationGroup::make()
                    ->label('User Management')
                    ->collapsed(true),

                NavigationGroup::make()
                    ->label('Roles And Permissions')
                    ->collapsed(true),

                NavigationGroup::make()
                    ->label('Advanced Masters')
                    ->collapsed(true),

            ]);
        });
    }
}
