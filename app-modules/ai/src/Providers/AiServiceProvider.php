<?php

namespace Helpz\Ai\Providers;

use Helpz\Ai\Services\AiManager;
use Helpz\Ai\Services\Providers\GeminiClient;
use Helpz\Ai\Services\Providers\MistralClient;
use Helpz\Ai\Services\Providers\XAiClient;
use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->singleton(AiManager::class, function($app) {
			return new AiManager([
				$app->make(MistralClient::class),
				$app->make(XAiClient::class),
				$app->make(GeminiClient::class)
			]);
		});
	}
	
	public function boot(): void
	{
	}
}
