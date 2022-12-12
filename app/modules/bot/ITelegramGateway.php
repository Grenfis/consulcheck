<?php

namespace app\modules\bot;

use app\modules\bot\dto\TelegramGetUpdatesDto;

interface ITelegramGateway
{
    public function getUpdates(): TelegramGetUpdatesDto;
}