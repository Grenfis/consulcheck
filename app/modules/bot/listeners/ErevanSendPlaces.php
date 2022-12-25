<?php

namespace app\modules\bot\listeners;

use app\modules\bot\IGateway;
use app\modules\bot\ITelegramGateway;
use app\modules\checker\events\ErevanWasFindPlaces;
use app\modules\checker\events\Gyumri10WasFindPlaces;

class ErevanSendPlaces
{
    private IGateway $gateway;
    private ITelegramGateway $telegramGateway;

    public function __construct(IGateway $gateway, ITelegramGateway $telegramGateway)
    {
        $this->gateway = $gateway;
        $this->telegramGateway = $telegramGateway;
    }

    public function __invoke(ErevanWasFindPlaces $event)
    {
        $users = $this->gateway->getQueueUsers(QUEUE_EREVAN_5);
        $this->telegramGateway->sendDocumentToUsers(
            'В посольстве Еревана была найдена запись на 5 лет!',
            $event->path(),
            ...$users
        );
    }
}