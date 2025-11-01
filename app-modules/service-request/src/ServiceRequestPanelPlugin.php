<?php

namespace Helpz\ServiceRequest;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Helpz\ServiceRequest\Filament\Resources\ServiceRequests\ServiceRequestResource;

class ServiceRequestPanelPlugin implements Plugin
{
    public function getId(): string
    {
        return 'service-request';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            ServiceRequestResource::class
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}