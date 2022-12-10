<?php

namespace app\controllers\v1;

use app\controllers\Controller;
use app\modules\common\DI;
use app\modules\telegram\actions\PollUpdates;
use Auryn\InjectionException;

class Telegram extends Controller
{
    /**
     * @throws InjectionException
     */
    public function poll()
    {
        /** @var PollUpdates $action */
        $action = DI::instance()->make(PollUpdates::class);
        $action->poll();
    }
}