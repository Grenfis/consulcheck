<?php

namespace app\modules\common;

interface IEventDispatcher
{
    public function emit(object $event);
}