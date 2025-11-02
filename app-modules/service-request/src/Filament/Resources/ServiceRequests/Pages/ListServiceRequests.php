<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\ServiceRequestResource;

class ListServiceRequests extends ListRecords
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
