<?php

namespace Icetalker\FilamentStepper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Icetalker\FilamentStepper\FilamentStepper
 */
class FilamentStepper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filament-stepper';
    }
}
