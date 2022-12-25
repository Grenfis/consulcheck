<?php

namespace app\modules\bot\listeners;

use app\modules\bot\ITelegramGateway;
use app\modules\checker\events\ErevanCaptchaWasFound;
use app\modules\checker\events\Gyumri10CaptchaWasFound;

class SolveErevanCaptcha
{
    private ITelegramGateway $telegramGateway;

    public function __construct(ITelegramGateway $telegramGateway)
    {
        $this->telegramGateway = $telegramGateway;
    }

    public function __invoke(ErevanCaptchaWasFound $event)
    {
        $this->telegramGateway->sendErevanCaptchaMessageToAdmin($event->path());
    }
}