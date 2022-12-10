<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramInlineQuery extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_inline_query` (
              `id` bigint UNSIGNED COMMENT 'Unique identifier for this query',
              `user_id` bigint NULL COMMENT 'Unique user identifier',
              `location` CHAR(255) NULL DEFAULT NULL COMMENT 'Location of the user',
              `query` TEXT NOT NULL COMMENT 'Text of the query',
              `offset` CHAR(255) NULL DEFAULT NULL COMMENT 'Offset of the result',
              `chat_type` CHAR(255) NULL DEFAULT NULL COMMENT 'Optional. Type of the chat, from which the inline query was sent.',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
