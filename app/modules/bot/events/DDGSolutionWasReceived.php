<?php

namespace app\modules\bot\events;

class DDGSolutionWasReceived
{
    private array $solutions;

    public function __construct(array $solutions)
    {
        $this->solutions = $solutions;
    }

    public function solutions(): array
    {
        return $this->solutions;
    }
}