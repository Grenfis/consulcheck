<?php

namespace app\modules\bot\listeners;

use app\modules\bot\ITelegramGateway;
use app\modules\checker\events\DDOSCaptchaWasFound;

class SolveDDOSCaptcha
{
    private ITelegramGateway $telegramGateway;

    public function __construct(ITelegramGateway $telegramGateway)
    {
        $this->telegramGateway = $telegramGateway;
    }

    public function __invoke(DDOSCaptchaWasFound $event)
    {
        $this->telegramGateway->sendDDGMessageToAdmins($event->path());
    }
}