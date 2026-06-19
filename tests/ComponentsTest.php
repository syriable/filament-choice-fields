<?php

declare(strict_types=1);

use Filament\Forms\Components\Field;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Livewire\Component as LivewireComponent;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxList;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxStackedCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\CheckboxTable;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioList;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioStackedCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\RadioTable;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\SingleCheckboxCard;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\SingleCheckboxList;

use function Pest\Livewire\livewire;

/**
 * The four multiple-choice fields. State is an array of selected option values.
 */
dataset('checkbox fields', [
    'CheckboxList' => CheckboxList::class,
    'CheckboxCard' => CheckboxCard::class,
    'CheckboxStackedCard' => CheckboxStackedCard::class,
    'CheckboxTable' => CheckboxTable::class,
]);

/**
 * The four single-choice fields. State is a single scalar option value.
 */
dataset('radio fields', [
    'RadioList' => RadioList::class,
    'RadioCard' => RadioCard::class,
    'RadioStackedCard' => RadioStackedCard::class,
    'RadioTable' => RadioTable::class,
]);

/**
 * The single-option (boolean) fields. State is a boolean.
 */
dataset('single fields', [
    'SingleCheckboxCard' => SingleCheckboxCard::class,
    'SingleCheckboxList' => SingleCheckboxList::class,
]);

it('renders and stores an array for multiple-choice fields', function (string $class) {
    livewire(ChoiceFieldTestComponent::class, ['fieldClass' => $class])
        ->assertFormFieldExists('choice')
        ->assertSee('Option A')
        ->assertSee('Option B')
        ->assertSee('Option C')
        ->fillForm(['choice' => ['a', 'c']])
        ->assertFormSet(['choice' => ['a', 'c']])
        ->assertHasNoErrors();
})->with('checkbox fields');

it('renders and stores a scalar for single-choice fields', function (string $class) {
    livewire(ChoiceFieldTestComponent::class, ['fieldClass' => $class])
        ->assertFormFieldExists('choice')
        ->assertSee('Option A')
        ->assertSee('Option B')
        ->assertSee('Option C')
        ->fillForm(['choice' => 'b'])
        ->assertFormSet(['choice' => 'b'])
        ->assertHasNoErrors();
})->with('radio fields');

it('renders and stores a boolean for single-option fields', function (string $class) {
    livewire(ChoiceFieldTestComponent::class, ['fieldClass' => $class, 'withOptions' => false])
        ->assertFormFieldExists('choice')
        ->assertFormSet(['choice' => false])
        ->fillForm(['choice' => true])
        ->assertFormSet(['choice' => true])
        ->assertHasNoErrors();
})->with('single fields');

it('uses the expected view for every component', function () {
    expect(CheckboxList::make('x')->getView())->toBe('filament-choice-fields::components.checkbox-list')
        ->and(CheckboxCard::make('x')->getView())->toBe('filament-choice-fields::components.checkbox-cards')
        ->and(CheckboxStackedCard::make('x')->getView())->toBe('filament-choice-fields::components.checkbox-stacked-cards')
        ->and(CheckboxTable::make('x')->getView())->toBe('filament-choice-fields::components.checkbox-table')
        ->and(RadioList::make('x')->getView())->toBe('filament-choice-fields::components.radio-list')
        ->and(RadioCard::make('x')->getView())->toBe('filament-choice-fields::components.radio-cards')
        ->and(RadioStackedCard::make('x')->getView())->toBe('filament-choice-fields::components.radio-stacked-cards')
        ->and(RadioTable::make('x')->getView())->toBe('filament-choice-fields::components.radio-table')
        ->and(SingleCheckboxCard::make('x')->getView())->toBe('filament-choice-fields::components.single-checkbox-card')
        ->and(SingleCheckboxList::make('x')->getView())->toBe('filament-choice-fields::components.single-checkbox-list');
});

class ChoiceFieldTestComponent extends LivewireComponent implements HasForms
{
    use InteractsWithForms;

    /**
     * @var array<string, mixed>
     */
    public array $data = [];

    /** @var class-string<Field> */
    public string $fieldClass;

    public bool $withOptions = true;

    public function mount(string $fieldClass, bool $withOptions = true): void
    {
        $this->fieldClass = $fieldClass;
        $this->withOptions = $withOptions;

        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        $field = ($this->fieldClass)::make('choice');

        if ($this->withOptions) {
            $field->options([
                'a' => 'Option A',
                'b' => 'Option B',
                'c' => 'Option C',
            ]);
        }

        return $schema
            ->statePath('data')
            ->components([$field]);
    }

    public function render(): string
    {
        return <<<'BLADE'
            <div>
                {{ $this->form }}
            </div>
        BLADE;
    }
}
