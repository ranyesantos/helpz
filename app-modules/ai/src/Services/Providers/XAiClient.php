<?php

namespace Helpz\Ai\Services\Providers;

use Exception;
use Helpz\Ai\Enums\AiClientsEnum;
use Helpz\Ai\Services\Providers\Contracts\AiClientInterface;
use Helpz\User\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class XAiClient implements AiClientInterface
{
    public function summarize(string $text): string
    {
        return "Summarized text from ". AiClientsEnum::XAI->label() ."";
    }
}