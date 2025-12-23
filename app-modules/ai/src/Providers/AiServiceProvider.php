<?php

namespace Helpz\Ai\Providers;

use Helpz\Ai\Services\AiManager;
use Helpz\Ai\Services\Clients\GeminiClient;
use Helpz\Ai\Services\Clients\MistralClient;
use Helpz\Ai\Services\Clients\XAiClient;
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
