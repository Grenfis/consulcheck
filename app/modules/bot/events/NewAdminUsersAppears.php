<?php

namespace app\modules\bot\events;

class NewAdminUsersAppears
{
    private array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function users(): array
    {
        return $this->users;
    }
}