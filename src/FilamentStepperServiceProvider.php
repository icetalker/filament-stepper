<?php

namespace Icetalker\FilamentStepper;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;

class FilamentStepperServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->registerAssets();
        $this->bootLoaders();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-stepper')
            ->hasViews();
    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-stepper');
    }

    protected function registerAssets()
    {
        FilamentAsset::register([
            Css::make('stepper', __DIR__ .'/../dist/assets/css/stepper.css')
        ], 'filament-stepper');
    }
}
