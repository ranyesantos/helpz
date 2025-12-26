<?php

namespace Helpz\AiIntegration\Services\Clients\Contracts;

interface AiClientInterface
{
    public function analyzeReportUsefulness(string $text);
}