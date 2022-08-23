<?php

namespace Icetalker\FilamentStepper\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Icetalker\FilamentStepper\FilamentStepperServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function getPackageProviders($app)
    {
        return [
            FilamentStepperServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_filament-stepper_table.php.stub';
        $migration->up();
        */
    }
}
