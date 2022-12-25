<?php

namespace app\modules\checker\listeners;

use app\modules\bot\events\GeneralSolutionWasReceived;
use app\modules\checker\CheckerService;
use app\modules\checker\IErevanGateway;
use app\modules\checker\IGyumriGateway;

class SolveGeneralCaptcha
{
    private IGyumriGateway $g5gateway;
    private IGyumriGateway $g10gateway;
    private IErevanGateway $erevanGateway;

    public function __construct(IGyumriGateway $g5gateway, IGyumriGateway $g10gateway, IErevanGateway $eGateway)
    {
        $this->g5gateway = $g5gateway;
        $this->g10gateway = $g10gateway;
        $this->erevanGateway = $eGateway;
    }

    public function __invoke(GeneralSolutionWasReceived $event)
    {
        $solutions = $event->solutions();
        $completed = [];
        foreach ($solutions as $solution) {
            if (in_array($solution['dest'], $completed)) {
                continue;
            }

            switch ($solution['dest']) {
                case 'g5':
                    $this->g5gateway->openTab(GYUMRI_5_URL);
                    $this->g5gateway->enterGeneralCaptcha($solution['text']);
                    break;
                case 'g10':
                    $this->g10gateway->openTab(GYUMRI_10_URL);
                    $this->g10gateway->enterGeneralCaptcha($solution['text']);
                    break;
                case 'e':
                    break;
            }

            $completed[] = $solution['dest'];
        }
    }
}