<?php

namespace Helpz\AiIntegration\Enums;

enum ClientMethodsEnum: string
{
    case SUMMARIZE = 'summarize';
    case ANALYZE_REPORT_USEFULNESS = 'analyzeReportUsefulness';
}