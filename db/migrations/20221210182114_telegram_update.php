<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramUpdate extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_telegram_update` (
              `id` bigint UNSIGNED COMMENT 'Update''s unique identifier',
              `chat_id` bigint NULL DEFAULT NULL COMMENT 'Unique chat identifier',
              `message_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New incoming message of any kind - text, photo, sticker, etc.',
              `edited_message_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New version of a message that is known to the bot and was edited',
              `channel_post_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New incoming channel post of any kind - text, photo, sticker, etc.',
              `edited_channel_post_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New version of a channel post that is known to the bot and was edited',
              `inline_query_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New incoming inline query',
              `chosen_inline_result_id` bigint UNSIGNED DEFAULT NULL COMMENT 'The result of an inline query that was chosen by a user and sent to their chat partner',
              `callback_query_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New incoming callback query',
              `shipping_query_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New incoming shipping query. Only for invoices with flexible price',
              `pre_checkout_query_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New incoming pre-checkout query. Contains full information about checkout',
              `poll_id` bigint UNSIGNED DEFAULT NULL COMMENT 'New poll state. Bots receive only updates about polls, which are sent or stopped by the bot',
              `poll_answer_poll_id` bigint UNSIGNED DEFAULT NULL COMMENT 'A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.',
              `my_chat_member_updated_id` BIGINT UNSIGNED NULL COMMENT 'The bot''s chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.',
              `chat_member_updated_id` BIGINT UNSIGNED NULL COMMENT 'A chat member''s status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.',
              `chat_join_request_id` BIGINT UNSIGNED NULL COMMENT 'A request to join the chat has been sent',
            
              PRIMARY KEY (`id`),
              KEY `message_id` (`message_id`),
              KEY `chat_message_id` (`chat_id`, `message_id`),
              KEY `edited_message_id` (`edited_message_id`),
              KEY `channel_post_id` (`channel_post_id`),
              KEY `edited_channel_post_id` (`edited_channel_post_id`),
              KEY `inline_query_id` (`inline_query_id`),
              KEY `chosen_inline_result_id` (`chosen_inline_result_id`),
              KEY `callback_query_id` (`callback_query_id`),
              KEY `shipping_query_id` (`shipping_query_id`),
              KEY `pre_checkout_query_id` (`pre_checkout_query_id`),
              KEY `poll_id` (`poll_id`),
              KEY `poll_answer_poll_id` (`poll_answer_poll_id`),
              KEY `my_chat_member_updated_id` (`my_chat_member_updated_id`),
              KEY `chat_member_updated_id` (`chat_member_updated_id`),
              KEY `chat_join_request_id` (`chat_join_request_id`),
            
              FOREIGN KEY (`chat_id`, `message_id`) REFERENCES `tg_message` (`chat_id`, `id`),
              FOREIGN KEY (`edited_message_id`) REFERENCES `tg_edited_message` (`id`),
              FOREIGN KEY (`chat_id`, `channel_post_id`) REFERENCES `tg_message` (`chat_id`, `id`),
              FOREIGN KEY (`edited_channel_post_id`) REFERENCES `tg_edited_message` (`id`),
              FOREIGN KEY (`inline_query_id`) REFERENCES `tg_inline_query` (`id`),
              FOREIGN KEY (`chosen_inline_result_id`) REFERENCES `tg_chosen_inline_result` (`id`),
              FOREIGN KEY (`callback_query_id`) REFERENCES `tg_callback_query` (`id`),
              FOREIGN KEY (`shipping_query_id`) REFERENCES `tg_shipping_query` (`id`),
              FOREIGN KEY (`pre_checkout_query_id`) REFERENCES `tg_pre_checkout_query` (`id`),
              FOREIGN KEY (`poll_id`) REFERENCES `tg_poll` (`id`),
              FOREIGN KEY (`poll_answer_poll_id`) REFERENCES `tg_poll_answer` (`poll_id`),
              FOREIGN KEY (`my_chat_member_updated_id`) REFERENCES `tg_chat_member_updated` (`id`),
              FOREIGN KEY (`chat_member_updated_id`) REFERENCES `tg_chat_member_updated` (`id`),
              FOREIGN KEY (`chat_join_request_id`) REFERENCES `tg_chat_join_request` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
