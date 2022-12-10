<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramRequestLimiter extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_request_limiter` (
              `id` bigint UNSIGNED AUTO_INCREMENT COMMENT 'Unique identifier for this entry',
              `chat_id` char(255) NULL DEFAULT NULL COMMENT 'Unique chat identifier',
              `inline_message_id` char(255) NULL DEFAULT NULL COMMENT 'Identifier of the sent inline message',
              `method` char(255) DEFAULT NULL COMMENT 'Request method',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
