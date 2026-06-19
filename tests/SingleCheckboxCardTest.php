<?php

declare(strict_types=1);

use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconPosition;
use Livewire\Component as LivewireComponent;
use Syriable\Filament\Plugins\Translations\ChoiceFields\Filament\Forms\Components\SingleCheckboxCard;

use function Pest\Livewire\livewire;

it('uses the single checkbox card view and sensible defaults', function () {
    $field = SingleCheckboxCard::make('terms');

    expect($field->getView())->toBe('filament-choice-fields::components.single-checkbox-card')
        ->and($field->getColor())->toBe('primary')
        ->and($field->isLabelHidden())->toBeTrue()
        ->and($field->getHiddenInputIcon())->toBe('heroicon-s-check-circle')
        ->and($field->getHiddenInputs())->toBeFalse();
});

it('exposes the single-value styling API', function () {
    $field = SingleCheckboxCard::make('terms')
        ->label('Accept terms')
        ->description('You agree to our policies')
        ->selectedDescription('Thanks for agreeing')
        ->extra('Required')
        ->icon('heroicon-o-shield-check')
        ->iconPosition(IconPosition::After)
        ->badge('New')
        ->badgeColor('danger')
        ->badgeIcon('heroicon-o-bell')
        ->hiddenInputs()
        ->cursorPointer();

    expect($field->getDescription())->toBe('You agree to our policies')
        ->and($field->getSelectedDescription())->toBe('Thanks for agreeing')
        ->and($field->getExtra())->toBe('Required')
        ->and($field->getIcon())->toBe('heroicon-o-shield-check')
        ->and($field->getIconPosition())->toBe(IconPosition::After)
        ->and($field->getBadge())->toBe('New')
        ->and($field->getBadgeColor('New'))->toBe('danger')
        ->and($field->getBadgeIcon())->toBe('heroicon-o-bell')
        ->and($field->getHiddenInputs())->toBeTrue()
        ->and($field->hasCursorPointer())->toBeTrue();
});

it('renders the card and toggles a boolean state', function () {
    livewire(SingleCheckboxCardTestComponent::class)
        ->assertSee('Accept terms')
        ->assertSee('You agree to our policies')
        ->assertSee('Required')
        ->assertSet('data.terms', false)
        ->set('data.terms', true)
        ->assertSet('data.terms', true)
        ->assertHasNoErrors();
});

class SingleCheckboxCardTestComponent extends LivewireComponent implements HasSchemas
{
    use InteractsWithSchemas;

    /**
     * @var array<string, mixed>
     */
    public array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                SingleCheckboxCard::make('terms')
                    ->label('Accept terms')
                    ->description('You agree to our policies')
                    ->extra('Required'),
            ]);
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
