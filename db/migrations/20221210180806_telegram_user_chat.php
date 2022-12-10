<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramUserChat extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `tg_user_chat` (
              `user_id` bigint COMMENT 'Unique user identifier',
              `chat_id` bigint COMMENT 'Unique user or chat identifier',
            
              PRIMARY KEY (`user_id`, `chat_id`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              FOREIGN KEY (`chat_id`) REFERENCES `tg_chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
