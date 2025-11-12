<?php

namespace App\Filament\Resources\RelationManagerReceivers\Pages;

use App\Filament\Resources\RelationManagerReceivers\RelationManagerReceiverResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRelationManagerReceiver extends EditRecord
{
    protected static string $resource = RelationManagerReceiverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
