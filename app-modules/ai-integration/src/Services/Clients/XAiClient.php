<?php

namespace Helpz\AiIntegration\Services\Clients;

use Helpz\AiIntegration\Services\Clients\Contracts\AiClientInterface;
use Illuminate\Support\Facades\Log;

class XAiClient implements AiClientInterface
{
    public function analyzeReportUsefulness($text)
    {
        Log::info('method called in XAI client');
    }
}