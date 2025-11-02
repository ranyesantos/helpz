<?php

namespace Helpz\Device\Filament\Resources\Devices\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Helpz\Device\Filament\Resources\Devices\DeviceResource;

class EditDevice extends EditRecord
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
