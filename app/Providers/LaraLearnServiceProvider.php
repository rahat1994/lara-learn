<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;

class LaraLearnServiceProvider extends ServiceProvider
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
                    ->label(__('Lara Learn'))
                    ->icon('heroicon-s-academic-cap'),
            ]);
        });

        Filament::registerScripts([
            // 'https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js',
            'https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js'
        ]);
    }
}
