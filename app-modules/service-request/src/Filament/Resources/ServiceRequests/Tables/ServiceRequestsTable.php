<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Aberto por:')
                    ->searchable(),

                TextColumn::make('device.serial_number')
                    ->label('Dispositivo')
                    ->searchable(),

                TextColumn::make('status')
                    ->size(TextSize::Large)
                    ->badge()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
