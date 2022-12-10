<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramPoll extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_poll` (
              `id` bigint UNSIGNED COMMENT 'Unique poll identifier',
              `question` text NOT NULL COMMENT 'Poll question',
              `options` text NOT NULL COMMENT 'List of poll options',
              `total_voter_count` int UNSIGNED COMMENT 'Total number of users that voted in the poll',
              `is_closed` tinyint(1) DEFAULT 0 COMMENT 'True, if the poll is closed',
              `is_anonymous` tinyint(1) DEFAULT 1 COMMENT 'True, if the poll is anonymous',
              `type` char(255) COMMENT 'Poll type, currently can be “regular” or “quiz”',
              `allows_multiple_answers` tinyint(1) DEFAULT 0 COMMENT 'True, if the poll allows multiple answers',
              `correct_option_id` int UNSIGNED COMMENT '0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.',
              `explanation` varchar(255) DEFAULT NULL COMMENT 'Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters',
              `explanation_entities` text DEFAULT NULL COMMENT 'Special entities like usernames, URLs, bot commands, etc. that appear in the explanation',
              `open_period` int UNSIGNED DEFAULT NULL COMMENT 'Amount of time in seconds the poll will be active after creation',
              `close_date` timestamp NULL DEFAULT NULL COMMENT 'Point in time (Unix timestamp) when the poll will be automatically closed',
              `created_at` timestamp NULL DEFAULT NULL COMMENT 'Entry date creation',
            
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
