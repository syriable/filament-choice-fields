@php
    use function Filament\Support\get_color_css_variables;

    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 200, 400, 500, 600, 700, 800]),
    ]);

    $id = $getId();
    $statePath = $getStatePath();
    $label = $getLabel();
    $description = $getDescription();
    $selectedDescription = $getSelectedDescription();
    $extra = $getExtra();
    $icon = $getIcon();
    $iconPosition = $getIconPosition();
    $iconSize = $getIconSize();
    $badge = $getBadge();
    $badgeIcon = $getBadgeIcon();
    $hiddenInputs = $getHiddenInputs();
    $isDisabled = $isDisabled();
    $hasCursorPointer = $hasCursorPointer();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div class="fi-fo-single-checkbox-list">
        <label for="{{ $id }}" @class([
            'fi-fo-checkbox-list-option group flex rounded-md border border-gray-200 dark:border-gray-700 p-4 focus:outline-hidden has-checked:relative has-checked:border-custom-200 dark:has-checked:border-custom-500 has-checked:bg-custom-50 dark:has-checked:bg-custom-800/10 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
            'relative' => $hiddenInputs,
            'not-has-disabled:cursor-pointer' => $hasCursorPointer,
        ]) style="{{ $colors }}">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-3">
                    @if (!$hiddenInputs)
                        <input id="{{ $id }}" name="{{ $statePath }}" type="checkbox"
                            {{ $extraInputAttributeBag->merge(
                                    [
                                        'disabled' => $isDisabled,
                                        'required' => $isRequired() && (! $isConcealed()),
                                        'wire:loading.attr' => 'disabled',
                                        $wireModelAttribute => $statePath,
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
                            {{ $label }}
                            @if ($icon && $iconPosition->value === 'after')
                                <x-filament::icon :icon="$icon" :size="$iconSize" />
                            @endif
                            @if (filled($badge))
                                <x-filament::badge :color="$getBadgeColor($badge) ?? 'gray'" :icon="$badgeIcon"
                                    class="fi-fo-choice-option-badge shrink-0">
                                    {{ $badge }}
                                </x-filament::badge>
                            @endif
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
                    {{ $extraInputAttributeBag->merge(
                            [
                                'disabled' => $isDisabled,
                                'required' => $isRequired() && (! $isConcealed()),
                                'wire:loading.attr' => 'disabled',
                                $wireModelAttribute => $statePath,
                            ],
                            escape: false,
                        )->class([
                            'absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed',
                            'cursor-pointer' => $hasCursorPointer,
                        ]) }} />
            @endif
        </label>
    </div>
</x-dynamic-component>
