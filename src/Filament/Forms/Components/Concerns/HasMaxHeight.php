<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns;

use Closure;

trait HasMaxHeight
{
    protected string | Closure | null $maxHeight = null;

    public function maxHeight(string | Closure | null $height): static
    {
        $this->maxHeight = $height;

        return $this;
    }

    public function getMaxHeight(): ?string
    {
        $height = $this->evaluate($this->maxHeight);

        if (blank($height)) {
            return null;
        }

        return $height;
    }
}
