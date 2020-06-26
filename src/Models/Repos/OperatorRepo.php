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
trait OperatorRepo
{
    /**
     * Get operators.
     * 
     * @api ComparOperatorAPI
     * 
     * @param  int $count  How many categories to return (default = 10).
     * @param  int $offset How many categories to skip   (default = 0)
     *                     Use for pagination.
     * 
     * @return \Entities\Operator[]
     */
    public function getOperators(int $count = 10, int $offset = 0): array
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
                 `operator_id`,
                 `name`,
                 `website`,
                 `logo`,
                 `is_premium`
             FROM 
                 `operators`
             LIMIT ? OFFSET ?;',
            [$count, $offset]
        );

        return Entity::createEntities($rows, 'Operator');
    }
}