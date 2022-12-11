<?php

namespace app\modules\telegram;

use app\modules\common\dto\TelegramGetUpdatesDto;

interface ITelegramGateway
{
    public function getUpdates(): TelegramGetUpdatesDto;
}