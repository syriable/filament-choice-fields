@php
    use function Filament\Support\get_color_css_variables;
    use Filament\Support\Enums\GridDirection;
    use Filament\Support\Facades\FilamentView;

    $descriptions = $getDescriptions();
    $selectedDescriptions = $getSelectedDescriptions();
    $extras = $getExtras();
    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);

    $fieldWrapperView = $getFieldWrapperView();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $isHtmlAllowed = $isHtmlAllowed();
    $isBulkToggleable = $isBulkToggleable();
    $isDisabled = $isDisabled();
    $hasCursorPointer = $hasCursorPointer();
    $isSearchable = $isSearchable();
    $statePath = $getStatePath();
    $options = $getOptions();
    $livewireKey = $getLivewireKey();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
    $hiddenInputs = $getHiddenInputs();
    $iconPosition = $getIconPosition();
    $iconSize = $getIconSize();
    $maxHeight = $getMaxHeight();
@endphp

<x-dynamic-component :component="$fieldWrapperView" :field="$field">
    <div @if (FilamentView::hasSpaMode()) {{-- format-ignore-start --}}x-load="visible || event (x-modal-opened)"{{-- format-ignore-end --}}
        @else
            x-load @endif
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('checkbox-list', 'filament/forms') }}"
        x-data="checkboxListFormComponent({
            livewireId: @js($this->getId()),
        })" {{ $getExtraAlpineAttributeBag()->class(['fi-fo-checkbox-list']) }}>
        @if (!$isDisabled)
            @if ($isSearchable)
                <x-filament::input.wrapper inline-prefix :prefix-icon="\Filament\Support\Icons\Heroicon::MagnifyingGlass"
                    prefix-icon-alias="forms:components.checkbox-list.search-field"
                    class="fi-fo-checkbox-list-search-input-wrp">
                    <input placeholder="{{ $getSearchPrompt() }}" type="search"
                        x-model.debounce.{{ $getSearchDebounce() }}="search"
                        class="fi-input fi-input-has-inline-prefix" />
                </x-filament::input.wrapper>
            @endif

            @if ($isBulkToggleable && count($options))
                <div x-cloak class="fi-fo-checkbox-list-actions" wire:key="{{ $livewireKey }}.actions">
                    <span x-show="! areAllCheckboxesChecked" x-on:click="toggleAllCheckboxes()"
                        wire:key="{{ $livewireKey }}.actions.select-all">
                        {{ $getAction('selectAll') }}
                    </span>

                    <span x-show="areAllCheckboxesChecked" x-on:click="toggleAllCheckboxes()"
                        wire:key="{{ $livewireKey }}.actions.deselect-all">
                        {{ $getAction('deselectAll') }}
                    </span>
                </div>
            @endif
        @endif

        <fieldset
            {{ $getExtraAttributeBag()->merge(
                    [
                        'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
                    ],
                    escape: false,
                )->class(['fi-fo-checkbox-list-options', '-space-y-px rounded-md bg-white dark:bg-gray-900'])->style($maxHeight ? ["max-height: {$maxHeight}; overflow-y: auto"] : []) }}>
            @foreach ($options as $value => $label)
                @php
                    $id = str_replace('.', '-', $statePath) . '-' . $value;
                    $description = $descriptions[$value] ?? null;
                    $selectedDescription = $selectedDescriptions[$value] ?? null;
                    $extra = $extras[$value] ?? null;
                    $icon = $getOptionIcon($value, $label) ?? $getIcon($value);
                    $optionBadges = $getOptionBadges($value, $label);
                    $optionBadgeIcon = $getOptionBadgeIcon($value, $label);
                @endphp

                <label
                    @if ($isSearchable) wire:key="{{ $livewireKey }}.options.{{ $value }}"
                        x-show="
                            $el
                                .querySelector('.fi-fo-checkbox-list-option-label')
                                ?.innerText.toLowerCase()
                                .includes(search.toLowerCase()) ||
                                $el
                                    .querySelector('.fi-fo-checkbox-list-option-description')
                                    ?.innerText.toLowerCase()
                                    .includes(search.toLowerCase())
                        " @endif
                    for="{{ $id }}" @class([
                        'fi-fo-checkbox-list-option group flex border border-gray-200 dark:border-gray-700 p-4 first:rounded-tl-md first:rounded-tr-md last:rounded-br-md last:rounded-bl-md focus:outline-hidden has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
                        'relative' => $hiddenInputs,
                        'not-has-disabled:cursor-pointer' => $hasCursorPointer,
                    ]) style="{{ $colors }}">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-3">
                            @if (!$hiddenInputs)
                                <input id="{{ $id }}" name="{{ $statePath }}" type="checkbox"
                                    value="{{ $value }}"
                                    {{ $extraInputAttributeBag->merge(
                                            [
                                                'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                                'wire:loading.attr' => 'disabled',
                                                $wireModelAttribute => $statePath,
                                                'x-on:change' => $isBulkToggleable ? 'checkIfAllCheckboxesAreChecked()' : null,
                                            ],
                                            escape: false,
                                        )->class([
                                            'fi-checkbox-input shrink-0 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500',
                                            'fi-valid' => !$errors->has($statePath),
                                            'fi-invalid' => $errors->has($statePath),
                                        ]) }}
                                    style="{{ $colors }}" />
                            @endif
                            <span class="fi-fo-checkbox-list-option-label flex flex-col">
                                <span
                                    class="inline-flex items-center gap-2 text-sm font-medium text-gray-900 dark:text-gray-100 mt-1">
                                    @if ($icon && $iconPosition->value === 'before')
                                        <x-filament::icon :icon="$icon" :size="$iconSize" />
                                    @endif
                                    @if ($isHtmlAllowed)
                                        {!! $label !!}
                                    @else
                                        {{ $label }}
                                    @endif
                                    @if ($icon && $iconPosition->value === 'after')
                                        <x-filament::icon :icon="$icon" :size="$iconSize" />
                                    @endif
                                    @foreach ($optionBadges as $badgeKey => $optionBadge)
                                        <x-filament::badge :color="$getOptionBadgeColor($value, $label, $badgeKey)" :icon="$optionBadgeIcon"
                                            class="fi-fo-choice-option-badge shrink-0">
                                            {{ $optionBadge }}
                                        </x-filament::badge>
                                    @endforeach
                                </span>
                                @if (filled($description) || filled($selectedDescription))
                                    <span
                                        class="fi-fo-checkbox-list-option-description block text-sm text-gray-500 dark:text-gray-400">
                                        @if (filled($selectedDescription))
                                            <span class="group-has-checked:hidden">{{ $description }}</span>
                                            <span class="hidden group-has-checked:inline">{{ $selectedDescription }}</span>
                                        @else
                                            {{ $description }}
                                        @endif
                                    </span>
                                @endif
                            </span>
                        </div>
                        @if ($extra)
                            <span class="fi-fo-checkbox-list-option-extra text-sm text-gray-800 dark:text-gray-100">
                                {{ $extra }}
                            </span>
                        @endif
                    </div>
                    @if ($hiddenInputs)
                        <input id="{{ $id }}" name="{{ $statePath }}" type="checkbox"
                            value="{{ $value }}"
                            {{ $extraInputAttributeBag->merge(
                                    [
                                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                        'wire:loading.attr' => 'disabled',
                                        $wireModelAttribute => $statePath,
                                        'x-on:change' => $isBulkToggleable ? 'checkIfAllCheckboxesAreChecked()' : null,
                                    ],
                                    escape: false,
                                )->class([
                                    'absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed',
                                    'cursor-pointer' => $hasCursorPointer,
                                ]) }} />
                    @endif
                </label>
            @endforeach
        </fieldset>

        @if ($isSearchable)
            <div x-cloak x-show="search && ! visibleCheckboxListOptions.length"
                class="fi-fo-checkbox-list-no-search-results-message">
                {{ $getNoSearchResultsMessage() }}
            </div>
        @endif
    </div>
</x-dynamic-component>
