<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramShippingQuery extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_shipping_query` (
              `id` bigint UNSIGNED COMMENT 'Unique query identifier',
              `user_id` bigint COMMENT 'User who sent the query',
              `invoice_payload` CHAR(255) NOT NULL DEFAULT '' COMMENT 'Bot specified invoice payload',
              `shipping_address` CHAR(255) NOT NULL DEFAULT '' COMMENT 'User specified shipping address',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
