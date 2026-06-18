<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ChoiceFieldsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-choice-fields';

    public static string $viewNamespace = 'filament-choice-fields';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name);

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }
}
