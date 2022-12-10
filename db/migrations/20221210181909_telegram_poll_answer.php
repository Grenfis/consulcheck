<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramPollAnswer extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_poll_answer` (
              `poll_id` bigint UNSIGNED COMMENT 'Unique poll identifier',
              `user_id` bigint NOT NULL COMMENT 'The user, who changed the answer to the poll',
              `option_ids` text NOT NULL COMMENT '0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`poll_id`, `user_id`),
              FOREIGN KEY (`poll_id`) REFERENCES `tg_poll` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
