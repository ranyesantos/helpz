<?php

namespace Helpz\Device;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Helpz\Device\Filament\Resources\Devices\DeviceResource;

class DevicePanelPlugin implements Plugin
{
    public function getId(): string
    {
        return 'device';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            DeviceResource::class
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}