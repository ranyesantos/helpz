<?php

namespace Helpz\Report\Filament\Resources\Reports\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DeviceRelationManager extends RelationManager
{
    protected static string $relationship = 'device';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                TextInput::make('brand')
                    ->required()
                    ->maxLength(255),
                TextInput::make('device_code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('serial_number')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('model')
            ->columns([
                TextColumn::make('model'),
                TextColumn::make('brand'),
                TextColumn::make('device_code'),
                TextColumn::make('serial_number'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
