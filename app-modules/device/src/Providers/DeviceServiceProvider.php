<?php

namespace Helpz\Device\Providers;

use Filament\Panel;
use Helpz\Device\DevicePanelPlugin;
use Illuminate\Support\ServiceProvider;

class DeviceServiceProvider extends ServiceProvider
{
	public function register(): void
    {
        Panel::configureUsing(fn (Panel $panel) =>
			($panel->getId() !== 'admin') || $panel->plugin(new DevicePanelPlugin())
		);
    }
	
	public function boot(): void
	{
	}
}
