<?php

namespace app\modules\bot\events;

class UserWantsToErevan
{
    private int $userId;
    private int $userName;

    public function __construct(int $userId, string $userName)
    {
        $this->userId = $userId;
        $this->userName = $userName;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function userName(): int
    {
        return $this->userName;
    }
}