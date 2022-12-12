<?php

namespace app\modules\common;

interface ILogger
{
    public function warning(string $msg);

    public function info(string $msg);
}