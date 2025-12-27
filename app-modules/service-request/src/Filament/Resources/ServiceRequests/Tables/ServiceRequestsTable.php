<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Tables;

use Filament\Actions\Action;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Helpz\Report\Filament\Resources\Reports\Pages\CreateReport;
use Helpz\ServiceRequest\Models\ServiceRequest;
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
                //todo: currently it's looking like a <a> tag, change it to look like a button
                Action::make('finish')
                    ->hidden(fn(ServiceRequest $serviceRequest): bool =>
                        $serviceRequest->status->value === ServiceRequestStatusEnum::Done->value
                    )
                    ->url(fn (ServiceRequest $serviceRequest): string => 
                        CreateReport::getUrl([
                            'service_request_id' => $serviceRequest->getKey(),
                            'device_id' => $serviceRequest->device_id,
                        ]) 
                    )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
