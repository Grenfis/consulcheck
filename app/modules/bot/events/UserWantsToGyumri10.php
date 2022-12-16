<?php

namespace app\modules\bot\events;

class UserWantsToGyumri10
{
    private int $userId;
    private string $userName;

    public function __construct(int $userId, string $userName)
    {
        $this->userId = $userId;
        $this->userName = $userName;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function userName(): string
    {
        return $this->userName;
    }
}