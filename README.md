# Filament Form Component for Number Input Field 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/icetalker/filament-stepper.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-stepper)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/icetalker/filament-stepper/run-tests?label=tests)](https://github.com/icetalker/filament-stepper/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/icetalker/filament-stepper/Check%20&%20fix%20styling?label=code%20style)](https://github.com/icetalker/filament-stepper/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/icetalker/filament-stepper.svg?style=flat-square)](https://packagist.org/packages/icetalker/filament-stepper)

## Installation

You can install the package via composer:

```bash
composer require icetalker/filament-stepper
```

## Usage

```php
use Icetalker\FilamentStepper\Forms\Components\Stepper;

protected function getFormSchema(): array
{
    return [
        ...
        Stepper::make('quantity')
            ->minValue(1)
            ->maxValue(20)
            ->default(5);
        ...

    ];
}
```

### Available Methods

| Method | Description | Usage|
|:----:|----|----|
| step | Set interval for number input field | `Stepper::make('price')->step(0.01)`|
| default | Define a default value | `Stepper::make('quantity')->default(1000)` |
| maxValue | Define the max value that allow the user to input | `Stepper::make('quantity')->maxValue(10)` |
| minValue | Define the min value that allow the user to input | `Stepper::make('quantity')->minValue(2)` 
| placeHolder | Define a placeholder value for when it has no value | `Stepper::make('stock')->maxValue('Please input stock number')` 
| disableManualInput | Determine if the user could input the number manually | `Stepper::make('quantity')->disableManualInput()` <br/>  This sample will disable manual input, even so, user can still change the value through buttons. |
| ... | Other methods from filament forms field |

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [icetalker](https://github.com/icetalker)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
