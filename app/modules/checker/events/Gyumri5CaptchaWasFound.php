<?php

namespace app\modules\checker\events;

class Gyumri5CaptchaWasFound
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