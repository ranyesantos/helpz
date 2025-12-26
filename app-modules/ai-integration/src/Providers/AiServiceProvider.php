<?php

namespace Helpz\AiIntegration\Providers;

use Helpz\AiIntegration\Services\AiManager;
use Helpz\AiIntegration\Services\Clients\GeminiClient;
use Helpz\AiIntegration\Services\Clients\MistralClient;
use Helpz\AiIntegration\Services\Clients\XAiClient;
use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->singleton(AiManager::class, function($app) {
			return new AiManager([
				$app->make(MistralClient::class),
				$app->make(GeminiClient::class),
				$app->make(XAiClient::class),
			]);
		});
	}
	
	public function boot(): void
	{
	}
}
