@php
    use function Filament\Support\get_color_css_variables;

    $colors = \Illuminate\Support\Arr::toCssStyles([
        get_color_css_variables($getColor(), shades: [50, 100, 400, 500, 600, 700, 800]),
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
    <div class="fi-fo-single-checkbox-card">
        <label for="{{ $id }}" @class([
            'fi-fo-checkbox-list-option group relative flex rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 has-checked:outline-2 has-checked:-outline-offset-1 has-checked:outline-custom-600 dark:has-checked:outline-custom-500 has-focus-visible:outline-3 has-focus-visible:-outline-offset-1 has-disabled:opacity-60 has-disabled:cursor-not-allowed',
            'not-has-disabled:cursor-pointer' => $hasCursorPointer,
            'items-center' => empty($extra),
            'items-start' => !empty($extra),
        ]) style="{{ $colors }}">
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

            <div class="fi-fo-checkbox-list-option-text flex-1">
                <span
                    class="fi-fo-checkbox-list-option-label inline-flex items-center gap-2 text-sm font-medium text-gray-900 dark:text-gray-100 mt-1">
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
                        class="fi-fo-checkbox-list-option-description mt-1 block text-sm text-gray-500 dark:text-gray-400">@if (filled($selectedDescription))<span class="group-has-checked:hidden">{{ $description }}</span><span class="hidden group-has-checked:inline">{{ $selectedDescription }}</span>@else{{ $description }}@endif</span>
                @endif
                @if ($extra)
                    <span
                        class="fi-fo-checkbox-list-option-extra mt-6 block text-sm font-medium text-gray-900 dark:text-gray-100">{{ $extra }}</span>
                @endif
            </div>

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
                            'fi-checkbox-input mt-0.5 shrink-0 ms-3 checked:bg-custom-500 checked:border-custom-500 hover:checked:bg-custom-600 hover:checked:border-custom-600 focus:border-custom-500 focus:ring-custom-500',
                            'fi-valid' => !$errors->has($statePath),
                            'fi-invalid' => $errors->has($statePath),
                        ]) }}
                    style="{{ $colors }}" />
            @endif

            @if ($hiddenInputs)
                <x-filament::icon :icon="$getHiddenInputIcon()"
                    class="invisible size-5 text-custom-600 dark:text-custom-500 group-has-checked:visible absolute top-2 inset-e-2" />
            @endif
        </label>
    </div>
</x-dynamic-component>
