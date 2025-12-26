<?php

namespace Helpz\AiIntegration\Services\Clients;

use Helpz\AiIntegration\Services\Clients\Contracts\AiClientInterface;
use Helpz\AiIntegration\Shared\ClientAIProfile\AnalyzeReportUsefulnessProfile;
use Illuminate\Support\Facades\Log;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class MistralClient implements AiClientInterface
{
    public function __construct(
        protected AnalyzeReportUsefulnessProfile $AIprofile
    ){}

    public function analyzeReportUsefulness($text)
    {
        Log::info('method called into Mistral client');

        $response = Prism::structured()
            ->using(Provider::Mistral, 'magistral-medium-latest')
            ->withSystemPrompt($this->AIprofile->getContext())
            ->withSchema($this->AIprofile->getSchema())
            ->withPrompt($this->AIprofile->getTestUselessPrompt())
            ->asStructured();
            
        Log::info('response Mistral Client', [
            'method' => 'analyzeReportUsefulness',
            'response' => $response,
            'text' => $response->structured
        ]);

        return $response->structured;
    }
}