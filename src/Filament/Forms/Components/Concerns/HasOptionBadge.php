<?php

declare(strict_types=1);

namespace Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\Concerns;

use BackedEnum;
use Closure;
use Illuminate\Contracts\Support\Htmlable;

trait HasOptionBadge
{
    /**
     * @var array<array-key, string|Htmlable|Closure|null>|string|Htmlable|Closure|null
     */
    protected array | string | Htmlable | Closure | null $optionBadge = null;

    /**
     * @var array<string, string>|string|Closure|null
     */
    protected array | string | Closure | null $optionBadgeColor = 'gray';

    protected string | BackedEnum | Closure | null $optionBadgeIcon = null;

    /**
     * Resolve one or more badge labels per option. Return a single value, or an
     * array of values to show multiple badges. Use string keys (e.g.
     * ['used' => '...']) to target badges from optionBadgeColor(). Each value
     * (and array item) may be a string, Htmlable, or Closure; null/blank values
     * are skipped.
     *
     * @param  array<array-key, string|Htmlable|Closure|null>|string|Htmlable|Closure|null  $callback
     */
    public function optionHasBadge(array | string | Htmlable | Closure | null $callback): static
    {
        $this->optionBadge = $callback;

        return $this;
    }

    /**
     * @param  array<string, string>|string|Closure|null  $color
     */
    public function optionBadgeColor(array | string | Closure | null $color): static
    {
        $this->optionBadgeColor = $color;

        return $this;
    }

    public function optionBadgeIcon(string | BackedEnum | Closure | null $icon): static
    {
        $this->optionBadgeIcon = $icon;

        return $this;
    }

    /**
     * Keys are preserved so optionBadgeColor() can target a badge by its key.
     *
     * @return array<array-key, string|Htmlable>
     */
    public function getOptionBadges(mixed $value, mixed $label = null): array
    {
        $badges = $this->evaluate($this->optionBadge, [
            'value' => $value,
            'label' => $label,
        ]);

        if (blank($badges)) {
            return [];
        }

        $badges = is_array($badges) ? $badges : [$badges];

        return collect($badges)
            ->map(fn (string | Htmlable | Closure | null $badge): string | Htmlable | null => $this->evaluate($badge, [
                'value' => $value,
                'label' => $label,
            ]))
            ->filter(fn (string | Htmlable | null $badge): bool => filled($badge))
            ->all();
    }

    /**
     * Resolve the color for a specific badge. When the configured color is an
     * array, it is treated as a map keyed by the badge key (the key used in
     * optionHasBadge()); unmatched badges fall back to "gray".
     */
    public function getOptionBadgeColor(mixed $value, mixed $label = null, mixed $key = null): ?string
    {
        $color = $this->evaluate($this->optionBadgeColor, [
            'value' => $value,
            'label' => $label,
            'key' => $key,
        ]);

        if (is_array($color)) {
            return ((is_string($key) || is_int($key)) && array_key_exists($key, $color))
                ? $color[$key]
                : 'gray';
        }

        return $color;
    }

    public function getOptionBadgeIcon(mixed $value, mixed $label = null): string | BackedEnum | null
    {
        return $this->evaluate($this->optionBadgeIcon, [
            'value' => $value,
            'label' => $label,
        ]);
    }
}
