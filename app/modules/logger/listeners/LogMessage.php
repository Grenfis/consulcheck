<?php

namespace app\modules\logger\listeners;

use app\modules\common\events\LogMessage as EventLogMessage;
use app\modules\logger\Logger;

class LogMessage
{
    public function __invoke(EventLogMessage $event)
    {
        switch ($event->level()) {
            case EventLogMessage::WARN:
                Logger::instance()->warning($event->message());
                break;

            case EventLogMessage::INFO:
                Logger::instance()->info($event->message());
                break;
        }
    }
}