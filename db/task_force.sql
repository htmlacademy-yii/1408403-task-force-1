DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
    `id`                bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `email`             varchar(255) UNIQUE,
    `full_name`         varchar(255),
    `password`          varchar(255) COMMENT 'SHA256 password',
    `registration_date` datetime DEFAULT NOW()
);

DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile`
(
    `id`          bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`     bigint,
    `city_id`     int,
    `birthday`    date,
    `bio`         text,
    `tel`         varchar(255),
    `skype`       varchar(255),
    `telegram`    varchar(255),
    `avatar`      varchar(255),
    `is_employer` boolean DEFAULT true COMMENT 'field is described as role'
);

DROP TABLE IF EXISTS `user_work_story`;

CREATE TABLE `user_work_story`
(
    `id`              bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`         bigint,
    `attachment_path` varchar(255)
);

DROP TABLE IF EXISTS `user_settings`;

CREATE TABLE `user_settings`
(
    `id`                  bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`             bigint,
    `receive_new_message` boolean DEFAULT true COMMENT 'enables to receive notifications upon receiving new message',
    `task_update`         boolean DEFAULT true COMMENT 'enables to receive notifications upon task status update',
    `receive_new_review`  boolean DEFAULT true COMMENT 'enables to receive notifications upon receiving new review',
    `hide_contacts`       boolean DEFAULT false COMMENT 'hide contact from everybody except for customer',
    `profile_hidden`      boolean DEFAULT false COMMENT 'settings in notification enables to hide user profile'
);

DROP TABLE IF EXISTS `user_statistics`;

CREATE TABLE `user_statistics`
(
    `id`               bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`          bigint,
    `tasks_done`       bigint,
    `tasks_failed`     bigint,
    `reviews_done`     bigint,
    `reviews_received` bigint,
    `rating`           float
);

DROP TABLE IF EXISTS `favorite`;

CREATE TABLE `favorite`
(
    `id`               bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`          bigint,
    `favorite_user_id` bigint
);

DROP TABLE IF EXISTS `user_view`;

CREATE TABLE `user_view`
(
    `id`           bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`      bigint,
    `user_came_id` bigint
);

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `id`   int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` varchar(255) UNIQUE,
    `slug` text
);

DROP TABLE IF EXISTS `user_category`;

CREATE TABLE `user_category`
(
    `id`          bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`     bigint,
    `category_id` int
);

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task`
(
    `id`                 bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `created_at`         datetime DEFAULT CURRENT_TIMESTAMP,
    `created_by_user_id` bigint,
    `title`              text,
    `description`        longtext,
    `category_id`        int,
    `city_id`            int,
    `budget`             int,
    `expiration`         date,
    `lat`                float,
    `long`               float,
    `status`             char(20) DEFAULT 'new',
    `assigned_user_id`   bigint,
    `finished_status`    varchar(255) COMMENT 'status on task finishing'
);

DROP TABLE IF EXISTS `attachment`;

CREATE TABLE `attachment`
(
    `id`        bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `task_id`   bigint,
    `file_path` varchar(255)
);

DROP TABLE IF EXISTS `response`;

CREATE TABLE `response`
(
    `id`          bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `task_id`     bigint,
    `created_at`  datetime DEFAULT CURRENT_TIMESTAMP,
    `user_id`     bigint,
    `user_price`  bigint,
    `comment`     text,
    `is_canceled` boolean  DEFAULT false
);

DROP TABLE IF EXISTS `task_chat`;

CREATE TABLE `task_chat`
(
    `id`          bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `task_id`     bigint,
    `created_at`  datetime DEFAULT CURRENT_TIMESTAMP,
    `employer_id` bigint,
    `employee_id` bigint,
    `message`     text,
    `is_new`      boolean  DEFAULT true
);

DROP TABLE IF EXISTS `testimonial`;

CREATE TABLE `testimonial`
(
    `id`                 bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`            bigint,
    `created_at`         datetime DEFAULT CURRENT_TIMESTAMP,
    `created_by_user_id` bigint,
    `task_id`            bigint,
    `rank`               tinyint,
    `comment`            text
);

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city`
(
    `city_id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name`    varchar(255),
    `lat`     varchar(255),
    `long`    varchar(255)
);

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification`
(
    `id`         bigint PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_id`    bigint,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `title`      text,
    `is_viewed`  boolean  DEFAULT false,
    `task_id`    bigint,
    `type`       varchar(20) COMMENT '
message - message in chat,
executor - worker assigned,
close - task finished,
new review,
show my contacts'
);

ALTER TABLE `user_profile`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `user_profile`
    ADD FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

ALTER TABLE `user_statistics`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user_category`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `user_category`
    ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

ALTER TABLE `favorite`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `favorite`
    ADD FOREIGN KEY (`favorite_user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user_view`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `user_view`
    ADD FOREIGN KEY (`user_came_id`) REFERENCES `user` (`id`);

ALTER TABLE `notification`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `notification`
    ADD FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);

ALTER TABLE `user_settings`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `task`
    ADD FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);
ALTER TABLE `task`
    ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
ALTER TABLE `task`
    ADD FOREIGN KEY (`created_by_user_id`) REFERENCES `user` (`id`);
ALTER TABLE `task`
    ADD FOREIGN KEY (`assigned_user_id`) REFERENCES `user` (`id`);

ALTER TABLE `task_chat`
    ADD FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);
ALTER TABLE `task_chat`
    ADD FOREIGN KEY (`employer_id`) REFERENCES `user` (`id`);
ALTER TABLE `task_chat`
    ADD FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`);

ALTER TABLE `testimonial`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `testimonial`
    ADD FOREIGN KEY (`created_by_user_id`) REFERENCES `user` (`id`);
ALTER TABLE `testimonial`
    ADD FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);


ALTER TABLE `user_work_story`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `response`
    ADD FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);

ALTER TABLE `attachment`
    ADD FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);

ALTER TABLE `response`
    ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
