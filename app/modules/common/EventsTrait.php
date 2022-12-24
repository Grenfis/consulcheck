<?php

namespace app\modules\common;
trait EventsTrait
{
    private array $events = [];

    public function emit(object $event)
    {
        $this->events[] = $event;
    }

    public function events(): array
    {
        return $this->events;
    }
}