<?php

namespace app\controllers\v1\system;

use app\controllers\Controller;
use app\modules\checker\actions\AvailabilityCheck;
use app\modules\common\DI;
use app\modules\bot\actions\PollUpdates;
use Auryn\InjectionException;

class Cron extends Controller
{
    /**
     * @throws InjectionException
     */
    public function telegramGetUpdates()
    {
        /** @var PollUpdates $action */
        $action = DI::instance()->make(PollUpdates::class);
        $action->poll();
    }

    /**
     * @throws InjectionException
     */
    public function checkerCheck()
    {
        /** @var AvailabilityCheck $action */
        $action = DI::instance()->make(AvailabilityCheck::class);
        $action->check();
    }
}