<?php

namespace app\modules\telegram\events;

use app\modules\common\events\IEvent;

class UserWantsToGyumri5 implements IEvent
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