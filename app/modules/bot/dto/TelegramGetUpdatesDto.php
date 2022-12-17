<?php

namespace app\modules\bot\dto;

class TelegramGetUpdatesDto
{
    public bool $isOk;
    public string $description;
    public array $newAdmins;
    public array $usersToQueue;

    public function __construct(bool $isOk, string $description, array $newAdmins, array $usersToQueue)
    {
        $this->isOk = $isOk;
        $this->description = $description;
        $this->newAdmins = $newAdmins;
        $this->usersToQueue = $usersToQueue;
    }
}