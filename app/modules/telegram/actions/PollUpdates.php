<?php

namespace app\modules\telegram\actions;

use app\modules\common\events\EventsDispatcher;
use app\modules\common\ITelegramGateway;
use app\modules\telegram\events\GetUpdatesWasUnsuccessful;

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
            EventsDispatcher::instance()->emit(new GetUpdatesWasUnsuccessful($result->description));
        }
    }
}