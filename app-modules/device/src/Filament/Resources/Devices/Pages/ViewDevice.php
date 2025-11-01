<?php

namespace Helpz\Device\Filament\Resources\Devices\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Helpz\Device\Filament\Resources\Devices\DeviceResource;

class ViewDevice extends ViewRecord
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
