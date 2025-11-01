<?php

namespace Helpz\ServiceRequest\Providers;

use Filament\Panel;
use Helpz\ServiceRequest\ServiceRequestPanelPlugin;
use Illuminate\Support\ServiceProvider;

class ServiceRequestServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		Panel::configureUsing(fn (Panel $panel) => 
			($panel->getId() !== 'admin') || $panel->plugin(new ServiceRequestPanelPlugin())
		);
	}
	
	public function boot(): void
	{
	}
}
