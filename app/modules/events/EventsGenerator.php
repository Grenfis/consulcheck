<?php

namespace app\modules\events;

use League\Event\EventGenerator;
use League\Event\EventGeneratorBehavior;

class EventsGenerator implements EventGenerator
{
    use EventGeneratorBehavior;

    public function __construct(object ...$events)
    {
        foreach ($events as $event) {
            $this->recordEvent($event);
        }
    }
}