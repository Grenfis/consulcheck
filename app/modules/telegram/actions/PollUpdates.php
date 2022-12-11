<?php

namespace app\modules\telegram\actions;

use app\modules\common\events\EventsDispatcher;
use app\modules\common\events\LogMessage;
use app\modules\telegram\ITelegramGateway;

class PollUpdates
{
    private ITelegramGateway $gateway;

    public function __construct(ITelegramGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function poll()
    {
        $result = $this->gateway->getUpdates();
        if (!$result->isOk) {
            EventsDispatcher::instance()->emit(new LogMessage('Telegram error: ' . $result->description, LogMessage::WARN));
        }
    }
}