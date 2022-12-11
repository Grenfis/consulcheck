<?php

namespace app\modules\common;

use app\modules\common\dto\TelegramGetUpdatesDto;

interface ITelegramGateway
{
    public function getUpdates(): TelegramGetUpdatesDto;
}