<?php

namespace app\modules\telegram;

use app\modules\telegram\dto\TelegramGetUpdatesDto;

interface ITelegramGateway
{
    public function getUpdates(): TelegramGetUpdatesDto;
}