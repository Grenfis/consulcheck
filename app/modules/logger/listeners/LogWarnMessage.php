<?php

namespace app\modules\logger\listeners;

use app\modules\common\events\IEvent;
use app\modules\logger\Logger;

class LogWarnMessage
{
    public function __invoke(IEvent $event)
    {
        $json = json_encode($event);
        Logger::instance()->warning(
            $json
        );
    }
}