<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramEditedMessage extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_edited_message` (
              `id` bigint UNSIGNED AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
              `chat_id` bigint COMMENT 'Unique chat identifier',
              `message_id` bigint UNSIGNED COMMENT 'Unique message identifier',
              `user_id` bigint NULL COMMENT 'Unique user identifier',
              `edit_date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was edited in timestamp format',
              `text` TEXT COMMENT 'For text messages, the actual UTF-8 text of the message max message length 4096 char utf8',
              `entities` TEXT COMMENT 'For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text',
              `caption` TEXT COMMENT  'For message with caption, the actual UTF-8 text of the caption',
            
              PRIMARY KEY (`id`),
              KEY `chat_id` (`chat_id`),
              KEY `message_id` (`message_id`),
              KEY `user_id` (`user_id`),
            
              FOREIGN KEY (`chat_id`) REFERENCES `tg_chat` (`id`),
              FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `tg_message` (`chat_id`, `id`),
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
