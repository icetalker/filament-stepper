<?php

namespace Icetalker\FilamentStepper;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentStepperServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
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
}
