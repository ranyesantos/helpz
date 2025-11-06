<?php

namespace Helpz\Ai\Services\Providers;

use Helpz\Ai\Enums\AiClientsEnum;
use Helpz\Ai\Services\Providers\Contracts\AiClientInterface;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class MistralClient implements AiClientInterface
{
    public function summarize(string $text): string
    {
        $response = Prism::text()
            ->using(Provider::Mistral, 'magistral-medium-latest')
            ->withPrompt($text)
            ->asText();
        dd($response);
        return "Summarized text from ". AiClientsEnum::Mistral->label() ."";
    }
}