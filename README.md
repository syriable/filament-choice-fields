# Filament Choice Fields

[![Latest Version on Packagist](https://img.shields.io/packagist/v/syriable/filament-choice-fields.svg?style=flat-square)](https://packagist.org/packages/syriable/filament-choice-fields)
[![Tests](https://img.shields.io/github/actions/workflow/status/syriable/filament-choice-fields/tests.yml?label=tests&style=flat-square)](https://github.com/syriable/filament-choice-fields/actions/workflows/tests.yml)
[![Code Style](https://img.shields.io/github/actions/workflow/status/syriable/filament-choice-fields/fix-code-style.yml?label=code%20style&style=flat-square)](https://github.com/syriable/filament-choice-fields/actions/workflows/fix-code-style.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/syriable/filament-choice-fields.svg?style=flat-square)](https://packagist.org/packages/syriable/filament-choice-fields)

Filament Choice Fields adds eight rich selection fields to FilamentPHP. Four are
single-choice fields based on `Radio`, and four are multiple-choice fields based
on `CheckboxList`. On top of the familiar `options()` / `descriptions()` API they
add card, stacked-card and table layouts, per-option icons and badges, rich HTML
"extras", state-aware descriptions, and a scrollable options list.

## Requirements

- PHP 8.1+
- Filament 4 or 5

## Installation

**1.** Install the package via Composer:

```bash
composer require syriable/filament-choice-fields
```

**2.** Make sure you have a [custom Filament theme](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme). Then register the package's Blade views as a Tailwind source in your theme's CSS file so the utility classes are compiled:

```css
@source '../../../../vendor/syriable/filament-choice-fields/resources/**/*.blade.php';
```

**3.** Rebuild your assets so the theme picks up the new classes:

```bash
npm run build
# or, while developing
npm run dev
```

## Components

All fields live in the `Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components`
namespace. Import the ones you need:

```php
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxList;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxStackedCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxTable;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioList;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioStackedCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioTable;
```

| Field | Selection | Layout |
| --- | --- | --- |
| `CheckboxList` | multiple | Vertical list |
| `CheckboxCard` | multiple | Cards |
| `CheckboxStackedCard` | multiple | Stacked cards |
| `CheckboxTable` | multiple | Responsive table |
| `RadioList` | single | Vertical list |
| `RadioCard` | single | Cards |
| `RadioStackedCard` | single | Stacked cards |
| `RadioTable` | single | Responsive table |

### CheckboxList

Vertical list layout with descriptions and extras for multiple selections.

```php
CheckboxList::make('delivery_type')
    ->searchable()
    ->bulkToggleable()
    ->options([
        'standard' => 'Standard Delivery',
        'express' => 'Express Delivery',
        'overnight' => 'Overnight Delivery',
        'same_day' => 'Same Day Delivery',
    ])
    ->descriptions([
        'standard' => 'Delivery within 5-7 business days',
        'express' => 'Delivery within 2-3 business days',
        'overnight' => 'Next day delivery available',
        'same_day' => 'Delivery on the same day',
    ])
    ->extras([
        'standard' => '$5.00 flat rate',
        'express' => '$10.00 flat rate',
        'overnight' => '$20.00 flat rate',
        'same_day' => '$25.00 flat rate',
    ]);
```

### CheckboxCard

Card-based layout with descriptions and extras for multiple selections.

```php
CheckboxCard::make('delivery_type')
    ->searchable()
    ->bulkToggleable()
    ->options([
        'standard' => 'Standard Delivery',
        'express' => 'Express Delivery',
        'overnight' => 'Overnight Delivery',
    ])
    ->descriptions([
        'standard' => 'Delivery within 5-7 business days',
        'express' => 'Delivery within 2-3 business days',
        'overnight' => 'Next day delivery available',
    ])
    ->extras([
        'standard' => '$5.00 flat rate',
        'express' => '$10.00 flat rate',
        'overnight' => '$20.00 flat rate',
    ]);
```

### CheckboxStackedCard

Stacked card layout with descriptions and extras for multiple selections.

```php
CheckboxStackedCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->bulkToggleable();
```

### CheckboxTable

Responsive table layout with descriptions for multiple selections.

```php
CheckboxTable::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->bulkToggleable();
```

### RadioList

Vertical list layout with descriptions.

```php
RadioList::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

### RadioCard

Card-based layout with descriptions and extras.

```php
RadioCard::make('plan')
    ->options([
        'hobby' => 'Hobby',
        'pro' => 'Pro',
    ])
    ->descriptions([
        'hobby' => 'For side projects',
        'pro' => 'For teams',
    ])
    ->extras([
        'hobby' => '$9/mo',
        'pro' => '$29/mo',
    ]);
```

### RadioStackedCard

Stacked card layout with descriptions and extras.

```php
RadioStackedCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

### RadioTable

Responsive table layout with descriptions.

```php
RadioTable::make('delivery_type')
    ->options(DeliveryTypeEnum::class);
```

## Single-option checkbox

Unlike the eight fields above (which present *many* options), `SingleCheckboxCard`
is a single boolean field — a styled wrapper around Filament's
`Filament\Forms\Components\Checkbox`. It stores `true`/`false` and renders one
card whose title is the field's `label()`. It reuses the same styling system as
the list-based fields (icon, badge, color, description, extra, hidden inputs),
but the content methods are **single values** rather than arrays keyed by option
value.

```php
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\SingleCheckboxCard;

SingleCheckboxCard::make('terms')
    ->label('Accept terms & conditions')
    ->description('You agree to our privacy policy and terms of service')
    ->icon('heroicon-o-shield-check');
```

The available methods mirror the list-based fields, in singular form:

| Method | Description |
| --- | --- |
| `label(...)` | The card title (the wrapper label is hidden to avoid duplication). |
| `description(...)` | Subtitle text. Accepts `string \| Htmlable \| Closure \| null`. |
| `selectedDescription(...)` | Swapped in while the box is checked (client-side, via `group-has-checked:`). |
| `extra(...)` | Trailing rich content (e.g. a price). |
| `icon(...)` / `iconPosition(...)` | Icon next to the title, before (default) or after. |
| `badge(...)` / `badgeColor(...)` / `badgeIcon(...)` | A badge next to the title. |
| `color(...)` | The accent color used when checked (default `primary`). |
| `hiddenInputs()` / `visibleInputs()` / `hiddenInputIcon(...)` | Hide the native checkbox and make the whole card clickable. |
| `cursorPointer()` | Show a pointer cursor over the card. |

```php
SingleCheckboxCard::make('newsletter')
    ->label('Subscribe to the newsletter')
    ->description('Get product updates once a month')
    ->selectedDescription('You will receive our next issue')
    ->badge('Recommended')
    ->badgeColor('success')
    ->color(\Filament\Support\Colors\Color::Emerald)
    ->hiddenInputs();
```

> Additional card styles for the single checkbox (stacked, table, …) will follow
> the same `Single*` naming once the card variant is stable.

## Search, bulk actions, and disabling options

These behaviours are inherited unchanged from FilamentPHP's `Radio` and
`CheckboxList` APIs.

Search:

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->searchable()
    ->searchPrompt('Search delivery types...')
    ->noSearchResultsMessage('No delivery types found.');
```

Bulk select (checkbox-style fields only):

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->bulkToggleable();
```

Disable a single option:

```php
CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->disableOptionWhen(fn (string $value): bool => $value === 'premium');
```

## Enum support

Pass a backed enum class name to `options()` instead of an array. The enum can
implement Filament's contracts to provide its label and description:

- `Filament\Support\Contracts\HasLabel` — the main label
- `Filament\Support\Contracts\HasDescription` — the subtitle

```php
<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum DeliveryTypeEnum: string implements HasDescription, HasLabel
{
    case Standard = 'standard';
    case Express = 'express';
    case Overnight = 'overnight';
    case SameDay = 'same_day';

    public function getLabel(): string
    {
        return match ($this) {
            self::Standard => __('Standard Delivery'),
            self::Express => __('Express Delivery'),
            self::Overnight => __('Overnight Delivery'),
            self::SameDay => __('Same Day Delivery'),
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Standard => __('Delivery within 5-7 business days'),
            self::Express => __('Delivery within 2-3 business days'),
            self::Overnight => __('Next day delivery available'),
            self::SameDay => __('Delivery on the same day'),
        };
    }
}
```

Use it in a schema:

```php
use App\Enums\DeliveryTypeEnum;
use Filament\Schemas\Schema;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioStackedCard;

public static function configure(Schema $schema): Schema
{
    return $schema
        ->columns(1)
        ->components([
            RadioStackedCard::make('delivery_type')
                ->options(DeliveryTypeEnum::class),
        ]);
}
```

To show extras for an enum, pass an `extras([...])` array keyed by the enum
value. If a case implements `getColor()`, supported layouts tint that option
(the same behaviour as core FilamentPHP enums).

## Customization

### Field color

```php
use Filament\Support\Colors\Color;

CheckboxCard::make('plan')
    ->options(Plan::class)
    ->color(Color::Rose);
```

### Selected descriptions

`selectedDescriptions()` shows a different description while an option is
selected. Keyed by option value just like `descriptions()`, it renders the
default text when the option is unchecked and swaps to the selected text once
it is checked. The swap happens instantly in the browser (via a
`group-has-checked:` CSS variant) with no extra server round-trip.

```php
RadioList::make('language')
    ->options($languages)
    ->descriptions([
        'en' => 'Click to select this language',
    ])
    ->selectedDescriptions([
        'en' => 'Selected as the browser language',
    ]);
```

Each value accepts `string | Htmlable`, and the method also accepts an
`Arrayable` or a `Closure`. An option that only defines a selected description
shows nothing until it is selected.

### Option icons

Add an icon next to each option's label, keyed by the option value. Use
`iconPosition()` to place the icon before (default) or after the label.

```php
use Filament\Support\Enums\IconPosition;

CheckboxList::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->icons([
        'standard' => 'heroicon-o-sparkles',
        'express' => 'heroicon-o-bolt',
        'overnight' => 'heroicon-o-moon',
        'same_day' => 'heroicon-o-clock',
    ])
    ->iconPosition(IconPosition::After);
```

### Dynamic option icons

When the icon depends on the option value, use `optionHasIcon()` with a closure
instead of building an `icons()` array. It receives the option `$value` (and
`$label`) and returns an icon name, enum, or `null`. It takes precedence over
`icons()` and still respects `iconPosition()`.

```php
CheckboxList::make('language')
    ->options($languages)
    ->optionHasIcon(fn (string $value): string => "flag-language-{$value}");
```

### Option badges

`optionHasBadge()` renders one or more badges next to an option's label. Return
a single value, or an array to show multiple badges. Each value may be a string,
`Htmlable`, or `Closure`; `null`/blank values are skipped. The closure receives
the option `$value` (and `$label`).

```php
CheckboxList::make('language')
    ->options($languages)
    ->optionHasBadge(fn (string $value): string => $value);
```

Use string keys to render multiple badges and to target them from
`optionBadgeColor()`. Because colors are keyed by the badge **key** (not its
rendered label), the badge text itself may be a translation or a dynamic string:

```php
CheckboxList::make('language')
    ->options($languages)
    ->optionHasBadge(fn (string $value): array => [
        'code' => $value,
        'used' => fn () => Locale::query()->where('code', $value)->exists()
            ? __('Already added')
            : null,
    ])
    ->optionBadgeColor(fn (string $value): array => [
        'used' => 'danger',
    ]);
```

`optionBadgeColor()` also accepts a plain string or closure that returns a single
color applied to every badge. `optionBadgeIcon()` adds an icon to the badges.
Unmatched badges fall back to the `gray` color.

### Scrollable options (max height)

`maxHeight()` constrains the height of the options list and makes only the
options scroll — the search field and bulk-action buttons stay fixed. It accepts
any CSS length string (or a closure).

```php
CheckboxList::make('language')
    ->options($languages)
    ->searchable()
    ->maxHeight('20rem');
```

### Hide native inputs on cards

```php
CheckboxCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->hiddenInputs();
```

### Hidden input icon

By default, the hidden input icon for card components is
`heroicon-s-check-circle`. You can override it:

```php
RadioCard::make('delivery_type')
    ->options(DeliveryTypeEnum::class)
    ->hiddenInputIcon('heroicon-o-chevron-double-down')
    ->hiddenInputs();
```

`visibleInputs()` reverses `hiddenInputs()` (shows the native control again).

### Rich extras (HTML)

Each `extras()` value accepts `string | Htmlable | Closure | null`. Plain strings
are HTML-escaped, so they are safe by default. To render rich markup, pass an
`Htmlable` (for example via `str()->toHtmlString()` or `new HtmlString(...)`);
values may also be closures, which are resolved per option at render time.

```php
use Illuminate\Support\HtmlString;

CheckboxCard::make('plan')
    ->options([
        'basic' => 'Basic',
        'pro' => 'Pro',
        'team' => 'Team',
    ])
    ->extras([
        // Escaped automatically.
        'basic' => 'Free',
        // Rendered as raw HTML because it is Htmlable.
        'pro' => str('<span class="font-bold text-primary-600">$29/mo</span>')->toHtmlString(),
        // Closures are evaluated per option.
        'team' => fn (): HtmlString => new HtmlString('<b>$99/mo</b>'),
    ]);
```

> **Security:** only wrap trusted, developer-authored markup in `Htmlable`.
> Rendering user- or database-supplied content as raw HTML exposes the form to
> XSS. Escape any dynamic value with `e()` before adding it to an `Htmlable`
> extra.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions and pull requests are always welcome. Please run `composer lint`
and `composer test` before opening a PR to help keep CI green. See
[CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [syriable](https://github.com/syriable)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
