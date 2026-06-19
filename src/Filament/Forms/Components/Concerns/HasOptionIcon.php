<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns;

use BackedEnum;
use Closure;
use Illuminate\Contracts\Support\Htmlable;

trait HasOptionIcon
{
    protected string | BackedEnum | Htmlable | Closure | null $optionIcon = null;

    /**
     * Resolve an icon per option. Return an icon name (or enum/Htmlable) to show
     * an icon for that option, or null to hide it. Takes precedence over icons().
     */
    public function optionHasIcon(string | BackedEnum | Htmlable | Closure | null $callback): static
    {
        $this->optionIcon = $callback;

        return $this;
    }

    public function getOptionIcon(mixed $value, mixed $label = null): string | BackedEnum | Htmlable | null
    {
        return $this->evaluate($this->optionIcon, [
            'value' => $value,
            'label' => $label,
        ]);
    }
}
