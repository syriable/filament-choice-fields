<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

trait HasSelectedDescriptions
{
    /**
     * Descriptions shown only while an option is selected. They are keyed by the
     * option value, mirroring descriptions(). When an option has a selected
     * description, the default description is swapped for it on selection.
     *
     * @var array<array-key, string|Htmlable>|Arrayable<array-key, string|Htmlable>|Closure
     */
    protected array | Arrayable | Closure $selectedDescriptions = [];

    /**
     * @param  array<array-key, string|Htmlable>|Arrayable<array-key, string|Htmlable>|Closure  $descriptions
     */
    public function selectedDescriptions(array | Arrayable | Closure $descriptions): static
    {
        $this->selectedDescriptions = $descriptions;

        return $this;
    }

    /**
     * @return array<array-key, string|Htmlable>
     */
    public function getSelectedDescriptions(): array
    {
        $descriptions = $this->evaluate($this->selectedDescriptions);

        if ($descriptions instanceof Arrayable) {
            $descriptions = $descriptions->toArray();
        }

        return $descriptions;
    }

    /**
     * @param  array-key  $value
     */
    public function getSelectedDescription(mixed $value): string | Htmlable | null
    {
        return $this->getSelectedDescriptions()[$value] ?? null;
    }
}
