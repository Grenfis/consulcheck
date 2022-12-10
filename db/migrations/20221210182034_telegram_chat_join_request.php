<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramChatJoinRequest extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_chat_join_request` (
              `id` BIGINT UNSIGNED AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
              `chat_id` BIGINT NOT NULL COMMENT 'Chat to which the request was sent',
              `user_id` BIGINT NOT NULL COMMENT 'User that sent the join request',
              `date` TIMESTAMP NOT NULL COMMENT 'Date the request was sent in Unix time',
              `bio` TEXT NULL COMMENT 'Optional. Bio of the user',
              `invite_link` TEXT NULL COMMENT 'Optional. Chat invite link that was used by the user to send the join request',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`),
            
              FOREIGN KEY (`chat_id`) REFERENCES `tg_chat` (`id`),
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
