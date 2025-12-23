<?php

namespace Helpz\Report\Listeners;

use Helpz\Ai\Services\AiManager;
use Helpz\Report\Events\ReportCreated;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetAiUsefulnessFlag implements ShouldQueue
{
    /**
     * Class constructor.
     */
    public function __construct(
        private AiManager $aiManager
    ){}

    /**
     * Handle the event.
     */
    public function handle(ReportCreated $event): void
    {
        $report = $event->report;

        $response = $this->aiManager->analyzeReportUsefulness($report->description);

        DB::transaction(function () use ($report, $response){
            $report->update([
                'ai_useful' => $response['is_useful']
            ]);

            $report->serviceRequest()->update([
                'status' => ServiceRequestStatusEnum::Done->value
            ]);
        });
    }
}
