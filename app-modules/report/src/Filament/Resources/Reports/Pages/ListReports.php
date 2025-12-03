<?php

namespace Helpz\Report\Filament\Resources\Reports\Pages;

use Filament\Resources\Pages\ListRecords;
use Helpz\Report\Filament\Resources\Reports\ReportResource;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
