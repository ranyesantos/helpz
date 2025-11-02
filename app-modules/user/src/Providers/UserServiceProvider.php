<?php

namespace Helpz\User\Providers;

use Filament\Panel;
use Helpz\User\UserPanelPlugin;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		Panel::configureUsing(fn (Panel $panel) => 
			$panel->plugin(new UserPanelPlugin())
		);
	}
	
	public function boot(): void
	{
	}
}
