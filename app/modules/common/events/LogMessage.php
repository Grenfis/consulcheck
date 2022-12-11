<?php

namespace app\modules\common\events;

class LogMessage implements IEvent
{
    public const WARN = 1;
    public const INFO = 2;

    private string $message;
    private int $level;

    public function __construct(string $message, int $level)
    {
        $this->message = $message;
        $this->level = $level;
    }

    public function message():string
    {
        return $this->message;
    }

    public function level(): int
    {
        return $this->level;
    }
}