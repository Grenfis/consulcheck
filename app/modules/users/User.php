<?php

namespace app\modules\users;

use DateTime;

class User
{
    private int $userId;
    private string $userName;
    private ?string $firstName;
    private ?string $lastName;
    private bool $isAdmin;
    private bool $isActive;
    private DateTime $createdAt;

    public function __construct(
        int $userId,
        string $userName,
        ?string $firstName,
        ?string $lastName,
        bool $isAdmin,
        bool $isActive,
        DateTime $createdAt
    )
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isAdmin = $isAdmin;
        $this->isActive = $isActive;
        $this->createdAt = $createdAt;
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

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }


}