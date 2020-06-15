-- Host: mysql
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET AUTOCOMMIT = 0;
-- START TRANSACTION;
-- SET time_zone = "+00:00";

--
-- Database: `tp_comparoperator`
--

-- --------------------------------------------------------
--
-- public function getUserbyName(string $name): array
--
SELECT
    `user_id`,
    `name`,
    `created_at`,
    `ip`
FROM
    `users`
WHERE
    `name` = "Simplony";

-- --------------------------------------------------------
--
-- public function getUserById(int $user_id): array
--
SELECT
    `user_id`,
    `name`,
    `created_at`,
    `ip`
FROM
    `users`
WHERE
    `user_id` = 1;

-- --------------------------------------------------------

--
-- public function addUser(string $name, string $ip): array
--
INSERT INTO `users`(`name`, `created_at`, `ip`)
VALUES(
    'Simplony-Skeleton',
    '2020-05-10 07:01:00',
    INET_ATON('127.0.0.1')
);

-- --------------------------------------------------------
--
-- public function getLocations(int $count = 10, int $offset = 0): array
--
SELECT
    `location` AS `name`,
    `thumbnail`,
    COUNT(DISTINCT `destination_id`) AS `offering_count`
FROM
    `destinations`
GROUP BY
    `location`
LIMIT 10 OFFSET 0;

-- --------------------------------------------------------
--
-- public function getOfferings(string $location_name, int $count = 10, int $offset = 0): array
--
SELECT
    `destinations`.`destination_id`,
    `destinations`.`price`,
    `destinations`.`thumbnail`,
    `destinations`.`operator_id`,
    `operators`.`name` AS `operator`,
    `operators`.`website`,
    `operators`.`logo`,
    `operators`.`is_premium`,
    COUNT(DISTINCT `reviews`.`review_id`) AS `review_count`,
    AVG(`ratings`.`rating`) AS `operator_rating`
FROM
    `destinations`
LEFT JOIN
    `operators`
ON
    `destinations`.`operator_id` = `operators`.`operator_id`
LEFT JOIN
    `reviews`
ON
    `operators`.`operator_id` = `reviews`.`operator_id`
LEFT JOIN
    `ratings`
ON
    `operators`.`operator_id` = `ratings`.`operator_id`
WHERE
    `destinations`.`location` = 'Osaka'
GROUP BY
    `operators`.`operator_id`    
LIMIT 10 OFFSET 0;

-- --------------------------------------------------------
--
-- public function getFreshProducts(int $count = 10, int $offset = 0): array
--
SELECT
    `products`.`product_id`,
    `products`.`created_at`,
    `products`.`name`,
    `products`.`summary`,
    `products`.`website`,
    `products`.`thumbnail`,
    COUNT(DISTINCT `comments`.`comment_id`) AS `comments_count`,
    COUNT(DISTINCT `votes`.`user_id`) AS `votes_count`
FROM 
    `products`
LEFT JOIN
    `comments`
ON
    `products`.`product_id` = `comments`.`product_id`
LEFT JOIN
    `votes`
ON
    `products`.`product_id` = `votes`.`product_id`
GROUP BY
    `products`.`product_id`
ORDER BY
    `products`.`created_at` DESC
LIMIT 10 OFFSET 0;


-- --------------------------------------------------------
--
-- public function getOperatorReviews(int $operator_id, int $count = 10, int $offset = 0): array
--
SELECT
    `review_id`,
    `operator_id`,
    `user_id`,
    `created_at`,
    `message`
FROM
    `reviews`
WHERE
    `operator_id` = 6
LIMIT 10 OFFSET 0;
-- --------------------------------------------------------
-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- public function getPopularProducts(int $count = 10, int $offset = 0): array
--
SELECT
    `products`.`product_id`,
    `products`.`created_at`,
    `products`.`name`,
    `products`.`summary`,
    `products`.`website`,
    `products`.`thumbnail`,
    COUNT(DISTINCT `comments`.`comment_id`) AS `comments_count`,
    COUNT(DISTINCT `votes`.`user_id`) AS `votes_count`
FROM 
    `products`
LEFT JOIN
    `comments`
ON
    `products`.`product_id` = `comments`.`product_id`
LEFT JOIN
    `votes`
ON
    `products`.`product_id` = `votes`.`product_id`
GROUP BY
    `products`.`product_id`
ORDER BY
    `votes_count` DESC, `products`.`created_at` DESC
LIMIT 10 OFFSET 0

-- --------------------------------------------------------
--
-- public function getProductsCollection(
--     int $category_id,
--     int $count = 10,
--     int $offset = 0
-- ): array
--
SELECT
    `products`.`product_id`,
    `products`.`created_at`,
    `products`.`name`,
    `products`.`summary`,
    `products`.`website`,
    `products`.`thumbnail`,
    COUNT(DISTINCT `comments`.`comment_id`) AS `comments_count`,
    COUNT(DISTINCT `votes`.`user_id`) AS `votes_count`
FROM 
    `products`
INNER JOIN
    `collections`
ON
    `products`.`product_id` = `collections`.`product_id`
LEFT JOIN
    `comments`
ON
    `products`.`product_id` = `comments`.`product_id`
LEFT JOIN
    `votes`
ON
    `products`.`product_id` = `votes`.`product_id`
WHERE
    `collections`.`category_id` = 1
GROUP BY
    `products`.`product_id`
ORDER BY
    `votes_count` DESC, `products`.`created_at` DESC
LIMIT 10 OFFSET 0;

-- --------------------------------------------------------
--
-- public function findProductsByName(
--     string $search_string,
--     int $count = 10,
--     int $offset = 0
-- ): array 
--
SELECT
    `products`.`product_id`,
    `products`.`created_at`,
    `products`.`name`,
    `products`.`summary`,
    `products`.`website`,
    `products`.`thumbnail`,
    COUNT(DISTINCT `comments`.`comment_id`) AS `comments_count`,
    COUNT(DISTINCT `votes`.`user_id`) AS `votes_count`
FROM 
    `products`
LEFT JOIN
    `comments`
ON
    `products`.`product_id` = `comments`.`product_id`
LEFT JOIN
    `votes`
ON
    `products`.`product_id` = `votes`.`product_id`
WHERE
    `products`.`name` LIKE '%cal%'
GROUP BY
    `products`.`product_id`
ORDER BY
    `votes_count` DESC, `products`.`created_at` DESC
LIMIT 10 OFFSET 0;

-- --------------------------------------------------------
--
-- public function getProduct(int $product_id): array
--
SELECT
    `articles`.`product_id`,
    `articles`.`article_id`,
    `articles`.`content`,
    `articles`.`media`
FROM 
    `articles`
WHERE
    `articles`.`product_id` = 1;

-- --------------------------------------------------------
--
-- public function getUserVotes(int $user_id): array
--
SELECT
    `product_id`
FROM
    `votes`
WHERE
    `user_id` = 1;