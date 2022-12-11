<?php

namespace app\modules\common\dto;

class TelegramGetUpdatesDto
{
    public bool $isOk;
    public string $description;

    public function __construct(bool $isOk, string $description)
    {
        $this->isOk = $isOk;
        $this->description = $description;
    }
}