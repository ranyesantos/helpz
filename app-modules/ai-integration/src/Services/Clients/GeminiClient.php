<?php

namespace Helpz\AiIntegration\Services\Clients;

use Helpz\AiIntegration\Enums\AiClientsEnum;
use Helpz\AiIntegration\Services\Clients\Contracts\AiClientInterface;
use Helpz\AiIntegration\Shared\ClientAIProfile\AnalyzeReportUsefulnessProfile;
use Illuminate\Support\Facades\Log;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class GeminiClient implements AiClientInterface
{
    public function __construct(
        protected AnalyzeReportUsefulnessProfile $AIprofile
    ){}
    
    public function analyzeReportUsefulness($text)
    {
        Log::info('method called into Gemini client');

        $response = Prism::structured()
            ->using(Provider::Gemini, 'gemini-2.5-flash-lite')
            ->withSystemPrompt($this->AIprofile->getContext())
            ->withSchema($this->AIprofile->getSchema())
            ->withPrompt($this->AIprofile->getTestUselessPrompt())
            ->asStructured();
            
        Log::info('response gemini Client', [
            'method' => 'analyzeReportUsefulness',
            'response' => $response->structured,
        ]);

        return [
            'data' => $response->structured,
            'generated_by' => AiClientsEnum::GEMINI->value
        ];
    }
}