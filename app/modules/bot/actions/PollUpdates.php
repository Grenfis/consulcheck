<?php

namespace app\modules\bot\actions;

use app\modules\bot\ITelegramGateway;
use app\modules\common\ILogger;

class PollUpdates
{
    private ITelegramGateway $gateway;
    private ILogger $logger;

    public function __construct(ITelegramGateway $gateway, ILogger $logger)
    {
        $this->gateway = $gateway;
        $this->logger = $logger;
    }

    public function poll()
    {
        $result = $this->gateway->getUpdates();
        if (!$result->isOk) {
            $this->logger->warning('Telegram error: ' . $result->description);
        }
    }
}