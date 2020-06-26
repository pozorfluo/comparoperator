<?php


declare(strict_types=1);

namespace Models\Repos;

use Entities\Entity;

/**
 * @todo Rethink Repos as SoA when relevant.
 * @todo Consider using Entities as pure const definitions, never holding datas.
 * @todo Compare SoA vs AoS approaches for Repos.
 * @todo Consider that Repos need to mesh well with future write-through Cache.
 * @todo Consider mapping Entities network style in sparse arrays with id as 
 *       key. Each foreign key id used as a 'pointer' to another sparse array of
 *       entities. Foreign keys getters/setters would take care of resolving
 *       the indirection.
 */
trait DestinationRepo
{
    /**
     * Get locations.
     * 
     * @api ComparOperatorAPI
     * 
     * @param  int $count  How many categories to return (default = 10).
     * @param  int $offset How many categories to skip   (default = 0)
     *                     Use for pagination.
     * 
     * @return \Entities\Location[]
     */
    public function getLocations(int $count = 10, int $offset = 0): array
    {
        if ($count < 0) {
            $count = 10;
        }
        if ($offset < 0) {
            $offset = 0;
        }

        $rows = $this->execute(
            'comparoperator',
            'SELECT
                 `location` AS `name`,
                 `thumbnail`,
                 COUNT(DISTINCT `destination_id`) AS `offering_count`
             FROM
                 `destinations`
             GROUP BY
                 `location`
             LIMIT ? OFFSET ?;',
            [$count, $offset]
        );

        return Entity::createEntities($rows, 'Location');
    }

    /**
     * Get offerings for a given location.
     * 
     * @api ComparOperatorAPI
     * 
     * @param  int $count  How many products to return (default = 10).
     * @param  int $offset How many products to skip   (default = 0)
     *                     Use for pagination.
     * 
     * @return \Entities\Offering[]
     */
    public function getOfferings(
        string $location,
        int $count = 10,
        int $offset = 0
    ): array {

        if ($location === '') {
            return [];
        }
        if ($count < 0) {
            $count = 10;
        }
        if ($offset < 0) {
            $offset = 0;
        }

        $rows = $this->execute(
            'comparoperator',
            'SELECT
                 `destinations`.`destination_id`,
                 `destinations`.`operator_id`,
                 `destinations`.`created_at`,
                 `destinations`.`location`,
                 `destinations`.`price`,
                 `destinations`.`thumbnail`,
                 `operators`.`name` AS `operator`,
                 `operators`.`website`,
                 `operators`.`logo`,
                 `operators`.`is_premium`,
                 COUNT(DISTINCT `reviews`.`review_id`) AS `review_count`,
                 IFNULL(AVG(`reviews`.`rating`), 0.0) AS `operator_rating`
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
             WHERE
                 `destinations`.`location` = ?
             GROUP BY
                 `operators`.`operator_id`
             ORDER BY
                 `destinations`.`created_at` DESC
             LIMIT ? OFFSET ?;',
            [$location, $count, $offset]
        );

        return Entity::createEntities($rows, 'Offering');
    }

}