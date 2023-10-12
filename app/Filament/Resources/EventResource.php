<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $slug = 'events';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required(),

            DatePicker::make('starts_at')
                ->label('Starts Date'),

            DatePicker::make('ends_at')
                ->label('Ends Date'),

            Select::make('suppliers')
                ->relationship('suppliers', 'name')
                ->multiple()
                ->preload()
                ->live(),

            Select::make('states')
                ->relationship(
                    'states',
                    'name',
                    fn ($query, $get) => $query
                        ->whereHas('suppliers', fn ($query) => $query->whereIn('suppliers.id', $get('suppliers')))
                )
                ->multiple()
                ->preload(fn ($get) => $get('suppliers') !== null)
                ->live(),

            CheckboxList::make('cities')
                ->relationship(
                    'cities',
                    'name',
                    fn ($query, $get) => $query->whereIn('state_id', $get('states')),
                )
                ->bulkToggleable()
                // ->searchable()
                ->columns(2),

            Select::make('cities')
                ->relationship(
                    'cities',
                    'name',
                    fn ($query, $get) => $query->whereIn('state_id', $get('states')),
                )
                ->preload(fn ($get) => $get('states') !== null)
                ->multiple()
                ->columns(2),

            Placeholder::make('created_at')
                ->label('Created Date')
                ->content(fn (?Event $record): string => $record?->created_at?->diffForHumans() ?? '-'),

            Placeholder::make('updated_at')
                ->label('Last Modified Date')
                ->content(fn (?Event $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->searchable()
                ->sortable(),

            TextColumn::make('starts_at')
                ->label('Starts Date')
                ->date(),

            TextColumn::make('ends_at')
                ->label('Ends Date')
                ->date(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
