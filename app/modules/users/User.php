<?php

namespace app\modules\users;

use DateTimeImmutable;

class User
{
    private int $userId;
    private string $userName;
    private bool $isAdmin;
    private bool $isActive;
    private DateTimeImmutable $createdAt;

    public function __construct(
        int $userId,
        string $userName,
        bool $isAdmin
    )
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->isAdmin = $isAdmin;
        $this->isActive = true;
        $this->createdAt = new DateTimeImmutable();
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }


}