<?php

namespace Helpz\Report;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Helpz\Report\Filament\Resources\Reports\ReportResource;

class ReportPanelPlugin implements Plugin
{
    public function getId(): string
    {
        return 'report';
    }
    public function register(Panel $panel): void
    {
        $panel->resources([
            ReportResource::class
        ]);
    }

    public function boot($panel): void
    {
        //
    }
}