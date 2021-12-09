<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Application;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface RBACApplication
{
    /**
     * Gets the roles that a user has.
     *
     * @param string $name
     * @param string ...$domain
     * @return string[]
     */
    public function getRolesForUserProvider(string $name, string ...$domain): array;

    /**
     * Gets the users that has a role.
     *
     * @param string $name
     * @param string ...$domain
     *
     * @return string[]
     */
    public function getUsersForRoleProvider(string $name, string ...$domain): array;

    /**
     * Determines whether a user has a role.
     *
     * @param string $name
     * @param string $role
     * @param string ...$domain
     *
     * @return bool
     */
    public function hasRoleForUserProvider(string $name, string $role, string ...$domain): bool;

    /**
     * Adds a role for a user.
     * returns false if the user already has the role (aka not affected).
     *
     * @param string $user
     * @param string $role
     * @param string ...$domain
     * @return bool
     */
    public function addRoleForUserProvider(string $user, string $role, string ...$domain): bool;

    /**
     * @param string $user
     * @param string[] $roles
     * @param string ...$domain
     *
     * @return bool
     */
    public function addRolesForUserProvider(string $user, array $roles, string ...$domain): bool;

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
    public function deleteRoleForUserProvider(string $user, string $role, string ...$domain): bool;

    /**
     * Deletes all roles for a user.
     * Returns false if the user does not have any roles (aka not affected).
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return bool
     * @throws CasbinException
     */
    public function deleteRolesForUserProvider(string $user, string ...$domain): bool;

    /**
     * Deletes a user.
     * Returns false if the user does not exist (aka not affected).
     *
     * @param string $user
     *
     * @return bool
     */
    public function deleteUserProvider(string $user): bool;

    /**
     * Deletes a role.
     *
     * @param string $role
     * @return bool
     */
    public function deleteRoleProvider(string $role): bool;

    /**
     * Deletes a permission.
     * Returns false if the permission does not exist (aka not affected).
     *
     * @param string ...$permission
     *
     * @return bool
     */
    public function deletePermissionProvider(string ...$permission): bool;

    /**
     * Adds a permission for a user or role.
     * Returns false if the user or role already has the permission (aka not affected).
     *
     * @param string $user
     * @param string ...$permission
     *
     * @return bool
     */
    public function addPermissionForUserProvider(string $user, string ...$permission): bool;

    /**
     * AddPermissionsForUser adds multiple permissions for a user or role.
     * Returns false if the user or role already has one of the permissions (aka not affected).
     *
     * @param string $user
     * @param array  ...$permissions
     * @return bool
     */
    public function addPermissionsForUserProvider(string $user, array ...$permissions): bool;

    /**
     * Deletes a permission for a user or role.
     * Returns false if the user or role does not have the permission (aka not affected).
     *
     * @param string $user
     * @param string ...$permission
     *
     * @return bool
     */
    public function deletePermissionForUserProvider(string $user, string ...$permission): bool;

    /**
     * Deletes permissions for a user or role.
     * Returns false if the user or role does not have any permissions (aka not affected).
     *
     * @param string $user
     *
     * @return bool
     */
    public function deletePermissionsForUserProvider(string $user): bool;

    /**
     * Gets permissions for a user or role.
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return array
     */
    public function getPermissionsForUserProvider(string $user, string ...$domain): array;

    /**
     * Determines whether a user has a permission.
     *
     * @param string $user
     * @param string ...$permission
     *
     * @return bool
     */
    public function hasPermissionForUserProvider(string $user, string ...$permission): bool;

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
    public function getImplicitRolesForUserProvider(string $name, string ...$domain): array;

    /**
     * GetImplicitUsersForRole gets implicit users for a role.
     *
     * @param string $name
     * @param string ...$domain
     * @return array
     */
    public function getImplicitUsersForRoleProvider(string $name, string ...$domain): array;

    /**
     * GetImplicitResourcesForUser returns all policies that user obtaining in domain
     *
     * @param string $user
     * @param string ...$domain
     * @return array
     */
    public function getImplicitResourcesForUserProvider(string $user, string ...$domain): array;

    /**
     * Gets implicit permissions for a user or role.
     * Compared to getPermissionsForUser(), this function retrieves permissions for inherited roles.
     * For example:
     * p, admin, data1, read
     * p, alice, data2, read
     * g, alice, admin.
     *
     * getPermissionsForUser("alice") can only get: [["alice", "data2", "read"]].
     * But getImplicitPermissionsForUser("alice") will get: [["admin", "data1", "read"], ["alice", "data2", "read"]].
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return array
     */
    public function getImplicitPermissionsForUserProvider(string $user, string ...$domain): array;

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
    public function getImplicitUsersForPermissionProvider(string ...$permission): array;

    /**
     * GetAllUsersByDomain would get all users associated with the domain.
     *
     * @param string $domain
     * @return string[]
     */
    public function getAllUsersByDomainProvider(string $domain): array;

    /**
     * Gets the users that has a role inside a domain. Add by Gordon.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getUsersForRoleInDomainProvider(string $name, string $domain): array;

    /**
     * Gets the roles that a user has inside a domain.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getRolesForUserInDomainProvider(string $name, string $domain): array;

    /**
     * Gets permissions for a user or role inside a domain.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getPermissionsForUserInDomainProvider(string $name, string $domain): array;

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
    public function addRoleForUserInDomainProvider(string $user, string $role, string $domain): bool;

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
    public function deleteRoleForUserInDomainProvider(string $user, string $role, string $domain): bool;

    /**
     * DeleteAllUsersByDomain would delete all users associated with the domain.
     *
     * @param string $domain
     * @return bool
     */
    public function deleteAllUsersByDomainProvider(string $domain): bool;

    /**
     * DeleteDomains would delete all associated users and roles.
     * It would delete all domains if parameter is not provided.
     *
     * @param string ...$domains
     * @return bool
     */
    public function deleteDomainsProvider(string ...$domains): bool;
}
