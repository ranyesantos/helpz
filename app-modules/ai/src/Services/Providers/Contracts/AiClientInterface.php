<?php

namespace Helpz\Ai\Services\Providers\Contracts;

interface AiClientInterface
{
    public function summarize(string $text);
}