<?php

namespace app\modules\users;

interface IUserRepository
{
    public function add(User $user);
}