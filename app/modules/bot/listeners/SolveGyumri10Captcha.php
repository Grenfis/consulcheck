<?php

namespace app\modules\bot\listeners;

use app\modules\bot\ITelegramGateway;
use app\modules\checker\events\Gyumri10CaptchaWasFound;

class SolveGyumri10Captcha
{
    private ITelegramGateway $telegramGateway;

    public function __construct(ITelegramGateway $telegramGateway)
    {
        $this->telegramGateway = $telegramGateway;
    }

    public function __invoke(Gyumri10CaptchaWasFound $event)
    {
        $this->telegramGateway->sendGyumri10CaptchaMessageToAdmin($event->path());
    }
}