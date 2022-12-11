<?php

namespace app\modules\checker\actions;

use app\modules\checker\ISeleniumGateway;

class AvailabilityCheck
{
    private ISeleniumGateway $gateway;

    public function __construct(ISeleniumGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function check()
    {
    }
}