<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\CheckboxStackedCard as Base;
use Filament\Forms\Components\Concerns\HasIcons;
use Filament\Support\Concerns\HasIconPosition;
use Filament\Support\Concerns\HasIconSize;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns\HasMaxHeight;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns\HasOptionBadge;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns\HasOptionIcon;

class CheckboxStackedCard extends Base
{
    use HasIconPosition;
    use HasIcons;
    use HasIconSize;
    use HasMaxHeight;
    use HasOptionBadge;
    use HasOptionIcon;

    protected string $view = 'filament-choice-fields::components.checkbox-stacked-cards';

    protected function setUp(): void
    {
        parent::setUp();
    }
}
