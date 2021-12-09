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
interface RoleDomain
{
    /**
     * Gets the roles that a user has.
     *
     * @param string $name
     * @param string ...$domain
     * @return string[]
     */
    public function getRolesForUser(string $name, string ...$domain): array;

    /**
     * Determines whether a user has a role.
     *
     * @param string $name
     * @param string $role
     * @param string ...$domain
     *
     * @return bool
     */
    public function hasRoleForUser(string $name, string $role, string ...$domain): bool;

    /**
     * Adds a role for a user.
     * returns false if the user already has the role (aka not affected).
     *
     * @param string $user
     * @param string $role
     * @param string ...$domain
     * @return bool
     */
    public function addRoleForUser(string $user, string $role, string ...$domain): bool;

    /**
     * @param string $user
     * @param string[] $roles
     * @param string ...$domain
     *
     * @return bool
     */
    public function addRolesForUser(string $user, array $roles, string ...$domain): bool;

    /**
     * Deletes a role for a user.
     * returns false if the user does not have the role (aka not affected).
     *
     * @param string $user
     * @param string $role
     * @param string ...$domain
     *
     * @return bool
     */
    public function deleteRoleForUser(string $user, string $role, string ...$domain): bool;

    /**
     * Deletes all roles for a user.
     * Returns false if the user does not have any roles (aka not affected).
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return bool
     */
    public function deleteRolesForUser(string $user, string ...$domain): bool;

    /**
     * Deletes a role.
     *
     * @param string $role
     * @return bool
     */
    public function deleteRole(string $role): bool;

    /**
     * Gets implicit roles that a user has.
     * Compared to getRolesForUser(), this function retrieves indirect roles besides direct roles.
     * For example:
     * g, alice, role:admin
     * g, role:admin, role:user.
     *
     * getRolesForUser("alice") can only get: ["role:admin"].
     * But getImplicitRolesForUser("alice") will get: ["role:admin", "role:user"].
     *
     * @param string $name
     * @param string ...$domain
     *
     * @return array
     */
    public function getImplicitRolesForUser(string $name, string ...$domain): array;

    /**
     * Gets the roles that a user has inside a domain.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getRolesForUserInDomain(string $name, string $domain): array;

    /**
     * Adds a role for a user inside a domain.
     * returns false if the user already has the role (aka not affected).
     *
     * @param string $user
     * @param string $role
     * @param string $domain
     *
     * @return bool
     */
    public function addRoleForUserInDomain(string $user, string $role, string $domain): bool;

    /**
     * Deletes a role for a user inside a domain.
     * Returns false if the user does not have the role (aka not affected).
     *
     * @param string $user
     * @param string $role
     * @param string $domain
     *
     * @return bool
     */
    public function deleteRoleForUserInDomain(string $user, string $role, string $domain): bool;
}
