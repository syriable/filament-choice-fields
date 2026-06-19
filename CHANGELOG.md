# Changelog

All notable changes to `filament-choice-fields` will be documented in this file.

## 1.0.1 - 2026-06-19

**Full Changelog**: https://github.com/syriable/filament-choice-fields/compare/1.0.0...1.0.1

## Unreleased

### Added

- `SingleCheckboxCard`: a single-option (boolean) checkbox rendered with the
  choice-fields card UI. Wraps Filament's `Checkbox` and reuses the same styling
  system (icon, badge, color, description, `selectedDescription()`, extra, hidden
  inputs) with single-value methods. First of a planned `Single*` family.
- `SingleCheckboxList`: the flat list-row counterpart to `SingleCheckboxCard`,
  sharing the same single-value styling API. Hiding the native input relies on
  the checked background tint rather than a check icon.
- State-aware descriptions via `selectedDescriptions()`: show a different
  description while an option is selected, toggled client-side with no extra
  server round-trip.

## 1.0.0 - 2026-06-19

Initial release.

### Added

- Eight selection fields: `CheckboxList`, `CheckboxCard`, `CheckboxStackedCard`,
  `CheckboxTable`, `RadioList`, `RadioCard`, `RadioStackedCard`, and `RadioTable`.
- `options()`, `descriptions()`, and `extras()` support, including backed-enum
  options via `HasLabel` / `HasDescription`.
- Rich HTML `extras()` accepting `string | Htmlable | Closure | null`, with
  automatic escaping for plain strings.
- Per-option icons via `icons()` and `iconPosition()`, plus dynamic icons via
  `optionHasIcon()`.
- Per-option badges via `optionHasBadge()`, with keyed colors through
  `optionBadgeColor()` and badge icons through `optionBadgeIcon()`.
- Scrollable options list via `maxHeight()` (only the options scroll; search and
  bulk-action controls stay fixed).
- Card input customization via `hiddenInputs()`, `visibleInputs()`, and
  `hiddenInputIcon()`.
