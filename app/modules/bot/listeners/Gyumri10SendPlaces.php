<?php

namespace app\modules\bot\listeners;

use app\modules\bot\IGateway;
use app\modules\bot\ITelegramGateway;
use app\modules\checker\events\Gyumri10WasFindPlaces;

class Gyumri10SendPlaces
{
    private IGateway $gateway;
    private ITelegramGateway $telegramGateway;

    public function __construct(IGateway $gateway, ITelegramGateway $telegramGateway)
    {
        $this->gateway = $gateway;
        $this->telegramGateway = $telegramGateway;
    }

    public function __invoke(Gyumri10WasFindPlaces $event)
    {
        $users = $this->gateway->getQueueUsers(QUEUE_GYUMRI_10);
        $this->telegramGateway->sendDocumentToUsers(
            'В консульстве Гюмри была найдена запись на 10 лет!',
            $event->path(),
            ...$users
        );
    }
}