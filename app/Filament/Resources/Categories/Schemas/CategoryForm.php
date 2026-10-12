<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(callable $set, $state) => $set('slug', str($state)->slug())),
                TextInput::make('slug')
                    ->required()
                    ->unique(),
                Select::make('parent_id')
                    ->relationship('parent', 'name')
                    ->searchable(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
