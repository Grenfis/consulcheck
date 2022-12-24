<?php

namespace app\modules\bot\dto;

class TelegramGetUpdatesDto
{
    public bool $isOk;
    public string $description;
    public array $newAdmins;
    public array $usersToQueue;
    public array $solveDDG;
    public array $solveGeneral;

    public function __construct(
        bool $isOk,
        string $description,
        array $newAdmins,
        array $usersToQueue,
        array $solveDDG,
        array $solveGeneral
    )
    {
        $this->isOk = $isOk;
        $this->description = $description;
        $this->newAdmins = $newAdmins;
        $this->usersToQueue = $usersToQueue;
        $this->solveDDG = $solveDDG;
        $this->solveGeneral = $solveGeneral;
    }
}