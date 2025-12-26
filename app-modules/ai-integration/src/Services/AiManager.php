<?php

namespace Helpz\AiIntegration\Services;

use Exception;
use Helpz\AiIntegration\Enums\ClientMethodsEnum;
use Illuminate\Support\Facades\Log;
use Prism\Prism\Exceptions\PrismException;

final class AiManager
{
    public function __construct(
        /** @var AiClientInterface[] */
        protected array $providers
    )
    {}

    private function execute($method, ...$arguments)
    {
        foreach ($this->providers as $provider) {
            try {
                return $provider->{$method}(...$arguments);
            } catch (PrismException $e) {
                Log::error('AI provider failed', [
                    'error' => $e->getMessage(),
                    'provider' => $provider,
                    'method' => $method
                ]);
            }
        }
        
        Log::error('All AI providers failed to summarize the text', ['error' => $e->getMessage()]);
        throw new Exception('All AI providers failed to summarize the text');
    }

    public function analyzeReportUsefulness(string $reportResume)
    {
        return $this->execute(
            ClientMethodsEnum::ANALYZE_REPORT_USEFULNESS->value,
            $reportResume
        );
    }

    public function summarize(string $text)
    {
        return $this->execute(
            ClientMethodsEnum::SUMMARIZE->value, 
            $text
        );
    }
}