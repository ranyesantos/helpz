<?php

namespace Helpz\Ai\Services\Clients\Contracts;

interface AiClientInterface
{
    public function analyzeReportUsefulness(string $text);
}