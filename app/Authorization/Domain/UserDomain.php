<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Domain;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface UserDomain
{
    /**
     * Gets the users that has a role.
     *
     * @param string $name
     * @param string ...$domain
     *
     * @return string[]
     */
    public function getUsersForRole(string $name, string ...$domain): array;

    /**
     * Deletes a user.
     * Returns false if the user does not exist (aka not affected).
     *
     * @param string $user
     *
     * @return bool
     */
    public function deleteUser(string $user): bool;

    /**
     * GetImplicitUsersForRole gets implicit users for a role.
     *
     * @param string $name
     * @param string ...$domain
     * @return array
     */
    public function getImplicitUsersForRole(string $name, string ...$domain): array;

    /**
     * GetImplicitResourcesForUser returns all policies that user obtaining in domain
     *
     * @param string $user
     * @param string ...$domain
     * @return array
     */
    public function getImplicitResourcesForUser(string $user, string ...$domain): array;

    /**
     * Gets implicit users for a permission.
     * For example:
     * p, admin, data1, read
     * p, bob, data1, read
     * g, alice, admin
     * getImplicitUsersForPermission("data1", "read") will get: ["alice", "bob"].
     * Note: only users will be returned, roles (2nd arg in "g") will be excluded.
     *
     * @param string ...$permission
     *
     * @return array
     */
    public function getImplicitUsersForPermission(string ...$permission): array;

    /**
     * GetAllUsersByDomain would get all users associated with the domain.
     *
     * @param string $domain
     * @return string[]
     */
    public function getAllUsersByDomain(string $domain): array;

    /**
     * Gets the users that has a role inside a domain. Add by Gordon.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getUsersForRoleInDomain(string $name, string $domain): array;

    /**
     * DeleteAllUsersByDomain would delete all users associated with the domain.
     *
     * @param string $domain
     * @return bool
     */
    public function deleteAllUsersByDomain(string $domain): bool;
}
