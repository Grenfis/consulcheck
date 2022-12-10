<?php

namespace app\modules\telegram\actions;

use app\modules\common\ITelegramGateway;

class PollUpdates
{
    private ITelegramGateway $gateway;

    public function __construct(ITelegramGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function poll()
    {
        $this->gateway->getUpdates();
    }
}