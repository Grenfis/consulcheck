<?php

namespace app\modules\users;

class UserService
{
    private IRepository $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(int $userId, string $userName, bool $isAdmin)
    {
        $user = new User(
            $userId,
            $userName,
            $isAdmin,
        );
        $this->repository->add($user);
    }
}