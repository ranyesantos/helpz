<?php

namespace Helpz\Report\Listeners;

use Helpz\Ai\Services\AiManager;
use Helpz\Report\Events\ReportCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SetAiUsefulnessFlag implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected AiManager $aiManager
    ){}

    /**
     * Handle the event.
     */
    public function handle(ReportCreated $event): void
    {
        Log::info('listener triggered', [
            'event' => get_class($event),
            'report' => $event->report
        ]);

    }
}
