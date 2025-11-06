<?php

use Helpz\Ai\Enums\AiClientsEnum;
use Helpz\Ai\Services\AiManager;
use Helpz\Ai\Services\Providers\Contracts\AiClientInterface;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    $this->geminiClientMock = mock(AiClientInterface::class);
    $this->xAiClientMock = mock(AiClientInterface::class);
});

test('first provider is called if it\'s avaliable', function () {
    $this->xAiClientMock
        ->shouldReceive('summarize')
        ->andReturn(AiClientsEnum::XAI->label());

    $fuck = new AiManager([$this->xAiClientMock, $this->geminiClientMock]);
    $result = $fuck->summarize('This is a test text to be summarized');

    expect(AiClientsEnum::XAI->label())->toBe( $result);
});

test('fallback to second provider on failure', function () {
    Log::spy();

    $this->geminiClientMock
        ->shouldReceive('summarize')
        ->andThrow(new Exception('Provider failed'));

    $this->xAiClientMock
        ->shouldReceive('summarize')
        ->andReturn(AiClientsEnum::XAI->label());

    $aiManager = new AiManager([$this->geminiClientMock, $this->xAiClientMock]);

    $result = $aiManager->summarize('nihao fine shyt');

    expect($result)->toBe(AiClientsEnum::XAI->label());
    Log::shouldHaveReceived('warning')
        ->once();
});

test('works correctly using a single provider', function () {
    $this->geminiClientMock
        ->shouldReceive('summarize')
        ->andReturn(AiClientsEnum::GEMINI->label());

    $aiManager = new AiManager([$this->geminiClientMock]);

    $result = $aiManager->summarize('ni hao fine shyt');

    expect(AiClientsEnum::GEMINI->label())->toBe($result);
});

