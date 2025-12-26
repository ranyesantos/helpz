<?php

use Helpz\AiIntegration\Enums\AiClientsEnum;
use Helpz\AiIntegration\Enums\ClientMethodsEnum;
use Helpz\AiIntegration\Services\AiManager;
use Helpz\AiIntegration\Services\Clients\Contracts\AiClientInterface;
use Illuminate\Support\Facades\Log;
use Prism\Prism\Exceptions\PrismException;

beforeEach(function () {
    $this->geminiClientMock = mock(AiClientInterface::class);
    $this->xAiClientMock = mock(AiClientInterface::class);
});

test('first provider is called if it\'s avaliable', function () {
    $this->xAiClientMock
        ->shouldReceive(ClientMethodsEnum::ANALYZE_REPORT_USEFULNESS->value)
        ->andReturn(AiClientsEnum::XAI->label());

    $fuck = new AiManager([$this->xAiClientMock, $this->geminiClientMock]);
    $result = $fuck->analyzeReportUsefulness('This is a test text to be summarized');
    
    expect(AiClientsEnum::XAI->label())->toBe( $result);
});

test('fallback to second provider on failure', function () {
    Log::spy();

    $this->geminiClientMock
        ->shouldReceive(ClientMethodsEnum::ANALYZE_REPORT_USEFULNESS->value)
        ->andThrow(new PrismException);

    $this->xAiClientMock
        ->shouldReceive(ClientMethodsEnum::ANALYZE_REPORT_USEFULNESS->value)
        ->andReturn(AiClientsEnum::XAI->label());

    $aiManager = new AiManager([$this->geminiClientMock, $this->xAiClientMock]);

    $result = $aiManager->analyzeReportUsefulness('nihao fine shyt');

    expect($result)->toBe(AiClientsEnum::XAI->label());
    Log::shouldHaveReceived('error')
        ->once();
});

test('works correctly using a single provider', function () {
    $this->geminiClientMock
        ->shouldReceive(ClientMethodsEnum::ANALYZE_REPORT_USEFULNESS->value)
        ->andReturn(AiClientsEnum::GEMINI->label());

    $aiManager = new AiManager([$this->geminiClientMock]);

    $result = $aiManager->analyzeReportUsefulness('ni hao fine shyt');

    expect(AiClientsEnum::GEMINI->label())->toBe($result);
});

