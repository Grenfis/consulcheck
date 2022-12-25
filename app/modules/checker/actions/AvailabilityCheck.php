<?php

namespace app\modules\checker\actions;


use app\modules\checker\CheckerService;
use app\modules\common\IEventDispatcher;

class AvailabilityCheck
{
    private IEventDispatcher $dispatcher;
    private CheckerService $service;

    public function __construct(
        IEventDispatcher $dispatcher,
        CheckerService $service
    )
    {
        $this->dispatcher = $dispatcher;
        $this->service = $service;
    }

    public function check()
    {
        $this->service->check();;

        $this->dispatcher->emits(...$this->service->events());
    }
}