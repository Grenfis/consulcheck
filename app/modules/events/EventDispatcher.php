<?php

namespace app\modules\events;

use app\modules\common\DI;
use app\modules\common\IEventDispatcher;
use app\system\Common;
use League\Event\EventDispatcher as LeagueEventDispatcher;

class EventDispatcher implements IEventDispatcher
{
    private static ?LeagueEventDispatcher $dispatcher = null;

    public function __construct()
    {
        if (!self::$dispatcher) {
            self::$dispatcher = new LeagueEventDispatcher();

            $defs = require_once Common::getRoot() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'events.php';
            foreach (array_keys($defs) as $event) {
                foreach ($defs[$event] as $listener) {
                    self::$dispatcher->subscribeTo($event, DI::instance()->make($listener));
                }
            }
        }
    }

    public function emit(object $event)
    {
        self::$dispatcher->dispatch($event);
    }
}