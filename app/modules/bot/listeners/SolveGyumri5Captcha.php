<?php

namespace app\modules\bot\listeners;

use app\modules\bot\ITelegramGateway;
use app\modules\checker\events\DDOSCaptchaWasFound;
use app\modules\checker\events\Gyumri5CaptchaWasFound;

class SolveGyumri5Captcha
{
    private ITelegramGateway $telegramGateway;

    public function __construct(ITelegramGateway $telegramGateway)
    {
        $this->telegramGateway = $telegramGateway;
    }

    public function __invoke(Gyumri5CaptchaWasFound $event)
    {
        $this->telegramGateway->sendGyumri5CaptchaMessageToAdmin($event->path());
    }
}