<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramChat extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_chat` (
              `id` bigint COMMENT 'Unique identifier for this chat',
              `type` ENUM('private', 'group', 'supergroup', 'channel') NOT NULL COMMENT 'Type of chat, can be either private, group, supergroup or channel',
              `title` CHAR(255) DEFAULT '' COMMENT 'Title, for supergroups, channels and group chats',
              `username` CHAR(255) DEFAULT NULL COMMENT 'Username, for private chats, supergroups and channels if available',
              `first_name` CHAR(255) DEFAULT NULL COMMENT 'First name of the other party in a private chat',
              `last_name` CHAR(255) DEFAULT NULL COMMENT 'Last name of the other party in a private chat',
              `is_forum` TINYINT(1) DEFAULT 0 COMMENT 'True, if the supergroup chat is a forum (has topics enabled)',
              `all_members_are_administrators` tinyint(1) DEFAULT 0 COMMENT 'True if a all members of this group are admins',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
              `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
              `old_id` bigint DEFAULT NULL COMMENT 'Unique chat identifier, this is filled when a group is converted to a supergroup',
            
              PRIMARY KEY (`id`),
              KEY `old_id` (`old_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
