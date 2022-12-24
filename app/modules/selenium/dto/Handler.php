<?php

namespace app\modules\selenium\dto;

class Handler
{
    public string $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}