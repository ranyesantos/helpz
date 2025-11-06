<?php

namespace Helpz\Ai\Services\Providers;

use Helpz\Ai\Enums\AiClientsEnum;
use Helpz\Ai\Services\Providers\Contracts\AiClientInterface;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class GeminiClient implements AiClientInterface
{
    public function summarize(string $text): string
    {
        return "Summarized text from ". AiClientsEnum::GEMINI->label() ."";
    }
}