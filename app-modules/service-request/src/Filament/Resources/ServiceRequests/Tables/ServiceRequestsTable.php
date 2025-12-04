<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Tables;


use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Helpz\User\Models\User;

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

                TextColumn::make('technician.name')
                    ->label('Responsável:')
                    ->searchable(),

                TextColumn::make('device.serial_number')
                    ->label('Dispositivo')
                    ->searchable(),

                TextColumn::make('status')
                    ->size(TextSize::Large)
                    ->badge()
            ])
            ->filters([
                SelectFilter::make('Aberto Por:')
                    ->options(
                        User::pluck('name', 'id')->all()
                    )
                    ->attribute('user_id')
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
