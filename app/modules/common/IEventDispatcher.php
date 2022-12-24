<?php

namespace app\modules\common;

interface IEventDispatcher
{
    public function emit(object $event);

    public function emits(object ...$events);
}