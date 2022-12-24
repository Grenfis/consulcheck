<?php

namespace app\modules\checker;

interface IGyumriGateway
{
    public function openTab(string $url);

    public function findDDOSCaptcha(): string;
}