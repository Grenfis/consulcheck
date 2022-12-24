<?php

namespace app\modules\checker\listeners;

use app\modules\bot\events\DDGSolutionWasReceived;
use app\modules\checker\CheckerService;

class SolveDDGCaptcha
{
    private CheckerService $service;

    public function __construct(CheckerService $service)
    {
        $this->service = $service;
    }

    public function __invoke(DDGSolutionWasReceived $event)
    {
        $solution = $event->solutions()[0];
        $this->service->solveDDGCaptcha($solution['text']);
    }
}