<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TelegramMessage extends AbstractMigration
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
            CREATE TABLE IF NOT EXISTS `tg_message` (
              `chat_id` bigint COMMENT 'Unique chat identifier',
              `sender_chat_id` bigint COMMENT 'Sender of the message, sent on behalf of a chat',
              `id` bigint UNSIGNED COMMENT 'Unique message identifier',
              `message_thread_id` bigint(20) DEFAULT NULL COMMENT 'Unique identifier of a message thread to which the message belongs; for supergroups only',
              `user_id` bigint NULL COMMENT 'Unique user identifier',
              `date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was sent in timestamp format',
              `forward_from` bigint NULL DEFAULT NULL COMMENT 'Unique user identifier, sender of the original message',
              `forward_from_chat` bigint NULL DEFAULT NULL COMMENT 'Unique chat identifier, chat the original message belongs to',
              `forward_from_message_id` bigint NULL DEFAULT NULL COMMENT 'Unique chat identifier of the original message in the channel',
              `forward_signature` TEXT NULL DEFAULT NULL COMMENT 'For messages forwarded from channels, signature of the post author if present',
              `forward_sender_name` TEXT NULL DEFAULT NULL COMMENT 'Sender''s name for messages forwarded from users who disallow adding a link to their account in forwarded messages',
              `forward_date` timestamp NULL DEFAULT NULL COMMENT 'date the original message was sent in timestamp format',
              `is_topic_message` tinyint(1) DEFAULT 0 COMMENT 'True, if the message is sent to a forum topic',
              `is_automatic_forward` tinyint(1) DEFAULT 0 COMMENT 'True, if the message is a channel post that was automatically forwarded to the connected discussion group',
              `reply_to_chat` bigint NULL DEFAULT NULL COMMENT 'Unique chat identifier',
              `reply_to_message` bigint UNSIGNED DEFAULT NULL COMMENT 'Message that this message is reply to',
              `via_bot` bigint NULL DEFAULT NULL COMMENT 'Optional. Bot through which the message was sent',
              `edit_date` timestamp NULL DEFAULT NULL COMMENT 'Date the message was last edited in Unix time',
              `has_protected_content` tinyint(1) DEFAULT 0 COMMENT 'True, if the message can''t be forwarded',
              `media_group_id` TEXT COMMENT 'The unique identifier of a media message group this message belongs to',
              `author_signature` TEXT COMMENT 'Signature of the post author for messages in channels',
              `text` TEXT COMMENT 'For text messages, the actual UTF-8 text of the message max message length 4096 char utf8mb4',
              `entities` TEXT COMMENT 'For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text',
              `caption_entities` TEXT COMMENT 'For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption',
              `audio` TEXT COMMENT 'Audio object. Message is an audio file, information about the file',
              `document` TEXT COMMENT 'Document object. Message is a general file, information about the file',
              `animation` TEXT COMMENT 'Message is an animation, information about the animation',
              `game` TEXT COMMENT 'Game object. Message is a game, information about the game',
              `photo` TEXT COMMENT 'Array of PhotoSize objects. Message is a photo, available sizes of the photo',
              `sticker` TEXT COMMENT 'Sticker object. Message is a sticker, information about the sticker',
              `video` TEXT COMMENT 'Video object. Message is a video, information about the video',
              `voice` TEXT COMMENT 'Voice Object. Message is a Voice, information about the Voice',
              `video_note` TEXT COMMENT 'VoiceNote Object. Message is a Video Note, information about the Video Note',
              `caption` TEXT COMMENT  'For message with caption, the actual UTF-8 text of the caption',
              `contact` TEXT COMMENT 'Contact object. Message is a shared contact, information about the contact',
              `location` TEXT COMMENT 'Location object. Message is a shared location, information about the location',
              `venue` TEXT COMMENT 'Venue object. Message is a Venue, information about the Venue',
              `poll` TEXT COMMENT 'Poll object. Message is a native poll, information about the poll',
              `dice` TEXT COMMENT 'Message is a dice with random value from 1 to 6',
              `new_chat_members` TEXT COMMENT 'List of unique user identifiers, new member(s) were added to the group, information about them (one of these members may be the bot itself)',
              `left_chat_member` bigint NULL DEFAULT NULL COMMENT 'Unique user identifier, a member was removed from the group, information about them (this member may be the bot itself)',
              `new_chat_title` CHAR(255) DEFAULT NULL COMMENT 'A chat title was changed to this value',
              `new_chat_photo` TEXT COMMENT 'Array of PhotoSize objects. A chat photo was change to this value',
              `delete_chat_photo` tinyint(1) DEFAULT 0 COMMENT 'Informs that the chat photo was deleted',
              `group_chat_created` tinyint(1) DEFAULT 0 COMMENT 'Informs that the group has been created',
              `supergroup_chat_created` tinyint(1) DEFAULT 0 COMMENT 'Informs that the supergroup has been created',
              `channel_chat_created` tinyint(1) DEFAULT 0 COMMENT 'Informs that the channel chat has been created',
              `message_auto_delete_timer_changed` TEXT COMMENT 'MessageAutoDeleteTimerChanged object. Message is a service message: auto-delete timer settings changed in the chat',
              `migrate_to_chat_id` bigint NULL DEFAULT NULL COMMENT 'Migrate to chat identifier. The group has been migrated to a supergroup with the specified identifier',
              `migrate_from_chat_id` bigint NULL DEFAULT NULL COMMENT 'Migrate from chat identifier. The supergroup has been migrated from a group with the specified identifier',
              `pinned_message` TEXT NULL COMMENT 'Message object. Specified message was pinned',
              `invoice` TEXT NULL COMMENT 'Message is an invoice for a payment, information about the invoice',
              `successful_payment` TEXT NULL COMMENT 'Message is a service message about a successful payment, information about the payment',
              `connected_website` TEXT NULL COMMENT 'The domain name of the website on which the user has logged in.',
              `passport_data` TEXT NULL COMMENT 'Telegram Passport data',
              `proximity_alert_triggered` TEXT NULL COMMENT 'Service message. A user in the chat triggered another user''s proximity alert while sharing Live Location.',
              `forum_topic_created` TEXT DEFAULT NULL COMMENT 'Service message: forum topic created',
              `forum_topic_closed` TEXT DEFAULT NULL COMMENT 'Service message: forum topic closed',
              `forum_topic_reopened` TEXT DEFAULT NULL COMMENT 'Service message: forum topic reopened',
              `video_chat_scheduled` TEXT COMMENT 'Service message: video chat scheduled',
              `video_chat_started` TEXT COMMENT 'Service message: video chat started',
              `video_chat_ended` TEXT COMMENT 'Service message: video chat ended',
              `video_chat_participants_invited` TEXT COMMENT 'Service message: new participants invited to a video chat',
              `web_app_data` TEXT COMMENT 'Service message: data sent by a Web App',
              `reply_markup` TEXT NULL COMMENT 'Inline keyboard attached to the message',
            
              PRIMARY KEY (`chat_id`, `id`),
              KEY `user_id` (`user_id`),
              KEY `forward_from` (`forward_from`),
              KEY `forward_from_chat` (`forward_from_chat`),
              KEY `reply_to_chat` (`reply_to_chat`),
              KEY `reply_to_message` (`reply_to_message`),
              KEY `via_bot` (`via_bot`),
              KEY `left_chat_member` (`left_chat_member`),
              KEY `migrate_from_chat_id` (`migrate_from_chat_id`),
              KEY `migrate_to_chat_id` (`migrate_to_chat_id`),
            
              FOREIGN KEY (`user_id`) REFERENCES `tg_user` (`id`),
              FOREIGN KEY (`chat_id`) REFERENCES `tg_chat` (`id`),
              FOREIGN KEY (`forward_from`) REFERENCES `tg_user` (`id`),
              FOREIGN KEY (`forward_from_chat`) REFERENCES `tg_chat` (`id`),
              FOREIGN KEY (`reply_to_chat`, `reply_to_message`) REFERENCES `tg_message` (`chat_id`, `id`),
              FOREIGN KEY (`via_bot`) REFERENCES `tg_user` (`id`),
              FOREIGN KEY (`left_chat_member`) REFERENCES `tg_user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
        ");
    }
}
