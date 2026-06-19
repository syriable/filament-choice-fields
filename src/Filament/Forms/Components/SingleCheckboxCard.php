<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components;

use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasCursorPointer;
use CodeWithDennis\FilamentAdvancedChoice\Filament\Forms\Components\Concerns\HasHiddenInputs;
use Filament\Forms\Components\Checkbox;
use Filament\Support\Concerns\HasBadge;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Concerns\HasIcon;
use Filament\Support\Concerns\HasIconPosition;
use Filament\Support\Concerns\HasIconSize;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns\HasSingleCardContent;

/**
 * A single-option (boolean) checkbox rendered with the choice-fields card UI.
 *
 * Unlike CheckboxCard, which is a CheckboxList of many options, this is a
 * single Filament Checkbox: it stores a boolean and shows one card whose title
 * is the field label. It reuses the same styling system as the list-based
 * fields (icon, badge, color, descriptions, extras, hidden inputs).
 */
class SingleCheckboxCard extends Checkbox
{
    use HasBadge;
    use HasColor;
    use HasCursorPointer;
    use HasHiddenInputs;
    use HasIcon;
    use HasIconPosition;
    use HasIconSize;
    use HasSingleCardContent;

    protected string $view = 'filament-choice-fields::components.single-checkbox-card';

    protected function setUp(): void
    {
        parent::setUp();

        // The card renders the field label as its title, so hide the wrapper
        // label to avoid showing it twice. helperText(), hint() and validation
        // errors still render around the card via the field wrapper.
        $this->hiddenLabel();

        $this->color('primary');
        $this->hiddenInputIcon('heroicon-s-check-circle');
    }
}
