<?php

namespace App\Filament\Resources\RelationManagerReceivers\Pages;

use App\Filament\Resources\RelationManagerReceivers\RelationManagerReceiverResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRelationManagerReceivers extends ListRecords
{
    protected static string $resource = RelationManagerReceiverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
