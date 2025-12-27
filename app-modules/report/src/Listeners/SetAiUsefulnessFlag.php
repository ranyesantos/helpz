<?php

namespace Helpz\Report\Listeners;

use Helpz\AiIntegration\Services\AiManager;
use Helpz\Report\Events\ReportCreated;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

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
        
        if ($report->ai_useful !== null) {
            return;
        }

        $response = $this->aiManager->analyzeReportUsefulness($report->description);

        DB::transaction(function () use ($report, $response){
            $report->update([
                'ai_useful' => $response['data']['is_useful'],
                'description' => $response['data']['reason'],
                'generated_by' => $response['generated_by']
            ]);

            $report->serviceRequest()->update([
                'status' => ServiceRequestStatusEnum::Done->value
            ]);
        });
    }
}
