<?php

namespace app\modules\bot\events;

class UserWantsToGyumri5
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function userId(): int
    {
        return $this->userId;
    }
}