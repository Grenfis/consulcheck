<?php

namespace app\modules\common\events;

use app\system\Common;
use League\Event\EventDispatcher as LeagueEventDispatcher;

class EventsDispatcher
{
    private static ?self $instance = null;

    private LeagueEventDispatcher $dispatcher;

    public function __construct()
    {
        $defs =  require_once Common::getRoot() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'events.php';
        foreach (array_keys($defs) as $event) {
            foreach($defs[$event] as $listener) {
                $this->dispatcher->subscribeTo($event, $listener);
            }
        }
    }

    public static function instance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function emit(IEvent $event)
    {
        $this->dispatcher->dispatch($event);
    }
}