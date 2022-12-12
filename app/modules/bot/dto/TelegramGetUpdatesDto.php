<?php

namespace app\modules\bot\dto;

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