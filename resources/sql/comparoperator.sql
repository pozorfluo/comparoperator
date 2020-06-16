-- Host: mysql
-- PHP Version: 7.3.16
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
    AUTOCOMMIT = 0;

START TRANSACTION;

SET
    time_zone = "+00:00";

--
-- Database: `tp_comparoperator`
--
CREATE DATABASE IF NOT EXISTS `tp_comparoperator` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `tp_comparoperator`;

-- --------------------------------------------------------
--
-- Table structure for table `operators`
--
CREATE TABLE `operators` (
    `operator_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `website` VARCHAR(512) CHARACTER SET 'ascii' COLLATE 'ascii_general_ci' NOT NULL,
    `logo` VARCHAR(255) CHARACTER SET 'ascii' COLLATE 'ascii_general_ci' NOT NULL,
    `is_premium` TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`operator_id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `destinations`
--
-- @todo
--   Consider splitting destination to a location table and a separate 
--   offering/destinations table.
--
CREATE TABLE `destinations` (
    `destination_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `operator_id` MEDIUMINT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `price` DECIMAL(7,2) NOT NULL,
    `thumbnail` VARCHAR(255) CHARACTER SET 'ascii' COLLATE 'ascii_general_ci' NOT NULL,
    PRIMARY KEY (`destination_id`),
    INDEX freshness (`created_at`),
    CONSTRAINT `constraint_destinations_operator_fk`
        FOREIGN KEY `operators_fk` (`operator_id`) REFERENCES `operators` (`operator_id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
    `user_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(32) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `ip` VARBINARY(16) NOT NULL ,
    PRIMARY KEY (`user_id`),
    UNIQUE INDEX username (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `reviews`
--
CREATE TABLE `reviews` (
    `review_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `operator_id` MEDIUMINT UNSIGNED NOT NULL,
    `user_id` MEDIUMINT UNSIGNED NOT NULL,
    `created_at` DATETIME NOT NULL,
    `message` TEXT NOT NULL,
    PRIMARY KEY (`review_id`),
    INDEX freshness (`created_at`),
    CONSTRAINT `constraint_comments_operator_fk`
        FOREIGN KEY `operators_fk` (`operator_id`) REFERENCES `operators` (`operator_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `constraint_comments_user_fk`
        FOREIGN KEY `user_fk` (`user_id`) REFERENCES `users` (`user_id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `ratings`
--
CREATE TABLE `ratings` (
    `operator_id` MEDIUMINT UNSIGNED NOT NULL,
    `user_id` MEDIUMINT UNSIGNED NOT NULL,
    `rating` TINYINT UNSIGNED NOT NULL CHECK (rating <= 5),
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`operator_id`, `user_id`),
    INDEX freshness (`created_at`),
    CONSTRAINT `constraint_ratings_operator_fk`
        FOREIGN KEY `operators_fk` (`operator_id`) REFERENCES `operators` (`operator_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `constraint_ratings_user_fk`
        FOREIGN KEY `users_fk` (`user_id`) REFERENCES `users` (`user_id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

COMMIT;