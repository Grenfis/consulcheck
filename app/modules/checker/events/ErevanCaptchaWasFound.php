<?php

namespace app\modules\checker\events;

class ErevanCaptchaWasFound
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function path(): string
    {
        return $this->path;
    }
}