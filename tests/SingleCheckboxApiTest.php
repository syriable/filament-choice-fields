<?php

declare(strict_types=1);

use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\SingleCheckboxCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\SingleCheckboxList;

it('exposes the singular content API on single-option fields', function (string $class) {
    $field = $class::make('is_default')
        ->label('Default locale')
        ->description('Use this locale as the application default')
        ->selectedDescription('This is the application default')
        ->extra('Required');

    expect($field->getDescription())->toBe('Use this locale as the application default')
        ->and($field->getSelectedDescription())->toBe('This is the application default')
        ->and($field->getExtra())->toBe('Required');
})->with([
    'card' => SingleCheckboxCard::class,
    'list' => SingleCheckboxList::class,
]);

it('does not expose the plural multi-option methods', function (string $class, string $method) {
    $field = $class::make('is_default');

    expect(fn () => $field->{$method}([]))
        ->toThrow(BadMethodCallException::class);
})->with([
    [SingleCheckboxCard::class, 'descriptions'],
    [SingleCheckboxCard::class, 'selectedDescriptions'],
    [SingleCheckboxCard::class, 'extras'],
    [SingleCheckboxCard::class, 'options'],
    [SingleCheckboxList::class, 'descriptions'],
    [SingleCheckboxList::class, 'selectedDescriptions'],
    [SingleCheckboxList::class, 'extras'],
    [SingleCheckboxList::class, 'options'],
]);
