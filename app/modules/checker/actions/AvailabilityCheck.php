<?php

namespace app\modules\checker\actions;


use app\modules\checker\IErevanGateway;
use app\modules\checker\IGyumriGateway;

class AvailabilityCheck
{
    private IErevanGateway $erevanGateway;
    private IGyumriGateway $gyumriGateway;

    public function __construct(IErevanGateway $erevanGateway, IGyumriGateway $gyumriGateway)
    {
        $this->erevanGateway = $erevanGateway;
        $this->gyumriGateway = $gyumriGateway;
    }

    public function check()
    {

    }
}