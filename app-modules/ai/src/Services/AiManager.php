<?php

namespace Helpz\Ai\Services;

use Exception;
use Illuminate\Support\Facades\Log;

final class AiManager
{
    // protected array $providers = [];

    public function __construct(
        /** var AiClientInterface[] */
        protected array $providers
    )
    {}

    public function summarize(string $text)
    {
        foreach ($this->providers as $provider) {
            try {
                return $provider->summarize($text);
            } catch (\Throwable $e) {
                Log::warning('AI provider failed', ['error' => $e->getMessage()]);
            }
        }

        throw new \Exception('All AI providers failed to summarize the text');
    }
}