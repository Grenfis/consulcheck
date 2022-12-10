<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramCallbackQuery extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_callback_query` (
              `id` bigint UNSIGNED COMMENT 'Unique identifier for this query',
              `user_id` bigint NULL COMMENT 'Unique user identifier',
              `chat_id` bigint NULL COMMENT 'Unique chat identifier',
              `message_id` bigint UNSIGNED COMMENT 'Unique message identifier',
              `inline_message_id` CHAR(255) NULL DEFAULT NULL COMMENT 'Identifier of the message sent via the bot in inline mode, that originated the query',
              `chat_instance` CHAR(255) NOT NULL DEFAULT '' COMMENT 'Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent',
              `data` CHAR(255) NOT NULL DEFAULT '' COMMENT 'Data associated with the callback button',
              `game_short_name` CHAR(255) NOT NULL DEFAULT '' COMMENT 'Short name of a Game to be returned, serves as the unique identifier for the game',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
              KEY `chat_id` (`chat_id`),
              KEY `message_id` (`message_id`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`),
              FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `tg_message` (`chat_id`, `id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
