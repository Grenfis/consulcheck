<?php

namespace app\controllers\v1;

use app\controllers\Controller;
use app\modules\checker\actions\AvailabilityCheck;
use app\modules\common\DI;
use Auryn\InjectionException;

class Checker extends Controller
{
    /**
     * @throws InjectionException
     */
    public function check()
    {
        /** @var AvailabilityCheck $action */
        $action = DI::instance()->make(AvailabilityCheck::class);
        $action->check();
    }
}