<?php

namespace app\modules\checker\actions;


use app\modules\checker\events\DDOSCaptchaWasFound;
use app\modules\checker\IErevanGateway;
use app\modules\checker\IGyumriGateway;
use app\modules\common\IEventDispatcher;

class AvailabilityCheck
{
    private IErevanGateway $erevanGateway;
    private IGyumriGateway $gyumri5Gateway;
    private IGyumriGateway $gyumri10Gateway;
    private IEventDispatcher $dispatcher;

    public function __construct(
        IErevanGateway $erevanGateway,
        IGyumriGateway $gyumri5Gateway,
        IGyumriGateway $gyumri10Gateway,
        IEventDispatcher $dispatcher
    )
    {
        $this->erevanGateway = $erevanGateway;
        $this->gyumri5Gateway = $gyumri5Gateway;
        $this->gyumri10Gateway = $gyumri10Gateway;
        $this->dispatcher = $dispatcher;
    }

    public function check()
    {
        $this->gyumri5Gateway->openTab(GYUMRI_5_URL);

        try {
            $path = $this->gyumri5Gateway->findDDOSCaptcha();
            $this->dispatcher->emit(new DDOSCaptchaWasFound($path));
            return;
        } catch (\Exception $e) {
            // ожидаемо, если нет капчи
        }
    }
}