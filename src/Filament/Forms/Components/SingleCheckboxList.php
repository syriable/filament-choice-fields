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
 * A single-option (boolean) checkbox rendered as a flat list row.
 *
 * The list counterpart to SingleCheckboxCard: a compact, low-elevation row
 * (rather than an elevated card) wrapping Filament's Checkbox. It shares the
 * same single-value styling system (icon, badge, color, description,
 * selectedDescription, extra, hidden inputs).
 *
 * Unlike the card, hiding the native input with hiddenInputs() relies on the
 * checked background tint rather than a check icon, so hiddenInputIcon() is not
 * used here.
 */
class SingleCheckboxList extends Checkbox
{
    use HasBadge;
    use HasColor;
    use HasCursorPointer;
    use HasHiddenInputs;
    use HasIcon;
    use HasIconPosition;
    use HasIconSize;
    use HasSingleCardContent;

    protected string $view = 'filament-choice-fields::components.single-checkbox-list';

    protected function setUp(): void
    {
        parent::setUp();

        // The row renders the field label as its title, so hide the wrapper
        // label to avoid showing it twice. helperText(), hint() and validation
        // errors still render around the row via the field wrapper.
        $this->hiddenLabel();

        $this->color('primary');
    }
}
