<?php

namespace app\modules\users;

interface IRepository
{
    public function add(User $user);
    public function exists(int $userId): bool;
}