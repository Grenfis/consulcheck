<?php

namespace app\modules\users;

interface IUserRepository
{
    public function add(User $user);
    public function exists(int $userId): bool;
}