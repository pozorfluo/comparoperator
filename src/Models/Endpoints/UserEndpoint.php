<?php


declare(strict_types=1);

namespace Models\Endpoints;

use PDOException;
use Entities\User;

/**
 * @todo Break-up API into multiple files by endpoints.
 * @todo Consider using traits for endpoints and composing API by using endpoint
 *       traits.
 */
trait UserEndpoint
{
    /**
     * Get user info for a given user id.
     * 
     * @note
     *      Returns an empty array if given user id does NOT exist.
     * 
     * @api ComparOperatorAPI
     * 
     * @param  int $user_id
     * 
     * @return \Entities\User[]
     */
    public function getUserById(int $user_id): array
    {
        if ($user_id <= 0) {
            return [];
        }

        $rows = $this->execute(
            'comparoperator',
            'SELECT
                 `user_id`,
                 `name`,
                 `created_at`,
                 `ip`
             FROM
                 `users`
             WHERE
                 `user_id` = ?;',
            [$user_id]
        );

        return empty($rows) ? [] :  [new User($rows[0])];
    }

    /**
     * Get user info for a given user name.
     * 
     * @note
     *      Returns an empty array if given user name does NOT exist.
     * 
     * @api ComparOperatorAPI
     * 
     * @param  string $name
     * 
     * @return \Entities\User[]
     */
    public function getUserbyName(string $name): array
    {
        if ($name === '') {
            return [];
        }

        $rows = $this->execute(
            'comparoperator',
            'SELECT
                 `user_id`,
                 `name`,
                 `created_at`,
                 `ip`
             FROM
                 `users`
             WHERE
                 `name` = ?;',
            [$name]
        );

        return empty($rows) ? [] :  [new User($rows[0])];
    }

    /**
     * Register a given new user.
     * 
     * @note
     *      Returns an empty array if operation could NOT complete.
     * 
     * @api ComparOperatorAPI
     * 
     * @todo Consider not executing the query if validates on a required field.
     * 
     * @param  \Entities\User $new_user
     * 
     * @return \Entities\User[]
     */
    public function addUser(User $new_user): array
    {
        if (!$new_user->hasValidRequiredFields()) {
            return [];
        }

        try {
            $this->execute(
                'comparoperator',
                'INSERT INTO `users`(
                     `name`, 
                     `created_at`, 
                     `ip`)
                 VALUES(
                     ?,
                     ?,
                     ?);',
                [
                    $new_user->data['name'],
                    $new_user->data['created_at'],
                    $new_user->data['ip']
                ]
            );
        } catch (PDOException $e) {
            $error_msg = $e->getMessage();

            $duplicate_entry = 'Integrity constraint violation: 1062 Duplicate entry';
            if (strpos($error_msg, $duplicate_entry) !== false) {
                /* Name already exists */
                return [];
            } else {
                throw $e;
            }
        }

        return $this->getUserById($this->lastInsertId());
    }

}