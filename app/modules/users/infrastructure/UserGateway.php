<?php

namespace app\modules\users\infrastructure;

use app\modules\common\IDB;
use app\modules\users\IUserRepository;
use app\modules\users\User;

class UserGateway implements IUserRepository
{
    private IDB $db;

    public function __construct(IDB $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
    {
        $query = "
            INSERT INTO users(user_id, user_name, user_firstname, user_lastname, user_is_admin, user_is_active, user_created_at)
            VALUES (:user_id, :username, :firstname, :lastname, :is_admin, :is_active, :created_at);
        ";

        $this->db->prepare($query);
        $this->db->execute([
            ':user_id' => $user->userId(),
            ':username' => $user->userName(),
            ':firstname' => $user->firstName(),
            ':lastname' => $user->lastName(),
            ':is_admin' => $user->isAdmin(),
            ':is_active' => $user->isActive(),
            ':created_at' => $user->createdAt()->format('Y-m-d H:i:s')
        ]);
    }
}