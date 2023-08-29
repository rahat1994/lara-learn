<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Assets\AlpineComponent;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Js;

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
            ]);
        });

        FilamentAsset::register([
            // 'https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js',
            Js::make('sortable-js', 'https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js')->loadedOnRequest(),
            AlpineComponent::make('curriculumns-widget', __DIR__ . '/../../resources/js/dist/components/curriculumns-widget.js')
        ]);
    }
}
