<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramChosenInlineResult extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_chosen_inline_result` (
              `id` bigint UNSIGNED AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
              `result_id` CHAR(255) NOT NULL DEFAULT '' COMMENT 'The unique identifier for the result that was chosen',
              `user_id` bigint NULL COMMENT 'The user that chose the result',
              `location` CHAR(255) NULL DEFAULT NULL COMMENT 'Sender location, only for bots that require user location',
              `inline_message_id` CHAR(255) NULL DEFAULT NULL COMMENT 'Identifier of the sent inline message',
              `query` TEXT NOT NULL COMMENT 'The query that was used to obtain the result',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
