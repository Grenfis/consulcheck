<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramConversation extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_conversation` (
              `id` bigint(20) unsigned AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
              `user_id` bigint NULL DEFAULT NULL COMMENT 'Unique user identifier',
              `chat_id` bigint NULL DEFAULT NULL COMMENT 'Unique user or chat identifier',
              `status` ENUM('active', 'cancelled', 'stopped') NOT NULL DEFAULT 'active' COMMENT 'Conversation state',
              `command` varchar(160) DEFAULT '' COMMENT 'Default command to execute',
              `notes` text DEFAULT NULL COMMENT 'Data stored from command',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
              `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
            
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
              KEY `chat_id` (`chat_id`),
              KEY `status` (`status`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`),
              FOREIGN KEY (`chat_id`) REFERENCES `tg_chat` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}

