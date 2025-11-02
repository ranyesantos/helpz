<?php

namespace Helpz\ServiceRequest\Filament\Resources\ServiceRequests\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\ServiceRequestResource;

class EditServiceRequest extends EditRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
