<?php

namespace app\modules\telegram\events;

use app\modules\common\events\IEvent;

class NewAdminUserAppears implements IEvent
{
    private int $userId;
    private string $userName;
    private ?string $firstName;
    private ?string $lastName;

    public function __construct(int $userId, string $userName, ?string $firstName, ?string $lastName)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function firstName(): ?string
    {
        return $this->firstName;
    }

    public function lastName(): ?string
    {
        return $this->lastName;
    }
}