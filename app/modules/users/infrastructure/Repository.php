<?php

namespace app\modules\users\infrastructure;

use app\modules\common\IDB;
use app\modules\users\IRepository;
use app\modules\users\User;

class Repository implements IRepository
{
    private IDB $db;

    public function __construct(IDB $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
    {
        $query = "
            INSERT INTO users(user_id, user_name, user_is_admin, user_is_active, user_created_at)
            VALUES (:user_id, :username, :is_admin, :is_active, :created_at);
        ";

        $this->db->prepare($query);
        $this->db->execute([
            ':user_id' => $user->userId(),
            ':username' => $user->userName(),
            ':is_admin' => $user->isAdmin(),
            ':is_active' => $user->isActive(),
            ':created_at' => $user->createdAt()->format('Y-m-d H:i:s')
        ]);
    }

    public function exists(int $userId): bool
    {
        $query = "
            SELECT user_id FROM users WHERE user_id = :user_id;
        ";

        $this->db->prepare($query);
        $this->db->execute([
            ':user_id' => $userId,
        ]);

        return $this->db->result()['user_id'] !== null;
    }
}