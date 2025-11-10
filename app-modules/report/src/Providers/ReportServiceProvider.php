<?php

namespace Helpz\Report\Providers;

use Filament\Panel;
use Helpz\Report\ReportPanelPlugin;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		Panel::configureUsing(fn(Panel $panel) => 
			$panel->plugin(new ReportPanelPlugin())
		);
	}
	
	public function boot(): void
	{
	}
}
