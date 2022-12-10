<?php
declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class TelegramUser extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_user` (
              `id` bigint COMMENT 'Unique identifier for this user or bot',
              `is_bot` tinyint(1) DEFAULT 0 COMMENT 'True, if this user is a bot',
              `first_name` CHAR(255) NOT NULL DEFAULT '' COMMENT 'User''s or bot''s first name',
              `last_name` CHAR(255) DEFAULT NULL COMMENT 'User''s or bot''s last name',
              `username` CHAR(191) DEFAULT NULL COMMENT 'User''s or bot''s username',
              `language_code` CHAR(10) DEFAULT NULL COMMENT 'IETF language tag of the user''s language',
              `is_premium` tinyint(1) DEFAULT 0 COMMENT 'True, if this user is a Telegram Premium user',
              `added_to_attachment_menu` tinyint(1) DEFAULT 0 COMMENT 'True, if this user added the bot to the attachment menu',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
              `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date update',
            
              PRIMARY KEY (`id`),
              KEY `username` (`username`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
