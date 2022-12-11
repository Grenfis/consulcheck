<?php

namespace app\modules\telegram\events;

use app\modules\common\events\IEvent;

class GetUpdatesWasUnsuccessful implements IEvent
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }
}