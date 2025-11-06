<?php

namespace Helpz\Ai\Enums;

enum AiClientsEnum: string
{
    case GEMINI = 'gemini';
    case XAI = 'xai';
    case Mistral = 'mistral';

    public function label(): string
    {
        return match($this) {
            self::GEMINI => 'Gemini AI',
            self::XAI => 'X AI',
            self::Mistral => 'Mistral AI',
        };
    }
}
