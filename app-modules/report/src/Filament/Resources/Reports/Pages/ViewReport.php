<?php

namespace Helpz\Report\Filament\Resources\Reports\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Helpz\Report\Filament\Resources\Reports\ReportResource;

class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
