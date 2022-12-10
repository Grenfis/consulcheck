<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramChatMemberUpdated extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_chat_member_updated` (
              `id` BIGINT UNSIGNED AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
              `chat_id` BIGINT NOT NULL COMMENT 'Chat the user belongs to',
              `user_id` BIGINT NOT NULL COMMENT 'Performer of the action, which resulted in the change',
              `date` TIMESTAMP NOT NULL COMMENT 'Date the change was done in Unix time',
              `old_chat_member` TEXT NOT NULL COMMENT 'Previous information about the chat member',
              `new_chat_member` TEXT NOT NULL COMMENT 'New information about the chat member',
              `invite_link` TEXT NULL COMMENT 'Chat invite link, which was used by the user to join the chat; for joining by invite link events only',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`),
              FOREIGN KEY (`chat_id`) REFERENCES `tg_chat` (`id`),
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
