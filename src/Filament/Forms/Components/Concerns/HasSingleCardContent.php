<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns;

use BackedEnum;
use Closure;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Single-value content for the single-checkbox card family. Unlike the
 * list-based fields (which key description/extra by option value), a single
 * checkbox represents one boolean, so each piece of content is a single value.
 */
trait HasSingleCardContent
{
    protected string | Htmlable | Closure | null $description = null;

    protected string | Htmlable | Closure | null $selectedDescription = null;

    protected string | Htmlable | Closure | null $extra = null;

    protected string | BackedEnum | Closure | null $badgeIcon = null;

    public function description(string | Htmlable | Closure | null $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Description shown only while the checkbox is checked. When set, the
     * default description is swapped for it on selection, toggled client-side
     * via a `group-has-checked:` CSS variant with no server round-trip.
     */
    public function selectedDescription(string | Htmlable | Closure | null $description): static
    {
        $this->selectedDescription = $description;

        return $this;
    }

    public function extra(string | Htmlable | Closure | null $extra): static
    {
        $this->extra = $extra;

        return $this;
    }

    public function badgeIcon(string | BackedEnum | Closure | null $icon): static
    {
        $this->badgeIcon = $icon;

        return $this;
    }

    public function getDescription(): string | Htmlable | null
    {
        return $this->evaluate($this->description);
    }

    public function getSelectedDescription(): string | Htmlable | null
    {
        return $this->evaluate($this->selectedDescription);
    }

    public function getExtra(): string | Htmlable | null
    {
        return $this->evaluate($this->extra);
    }

    public function getBadgeIcon(): string | BackedEnum | null
    {
        return $this->evaluate($this->badgeIcon);
    }
}
