<?php

namespace app\modules\common;

interface ITelegramGateway
{
    public function getUpdates();
}