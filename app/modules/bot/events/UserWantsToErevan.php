<?php

namespace app\modules\bot\events;

use app\modules\common\events\IEvent;

class UserWantsToErevan implements IEvent
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