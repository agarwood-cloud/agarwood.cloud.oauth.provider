<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Interfaces\Rpc\Server;

use Agarwood\Rpc\OauthCenter\OauthCenterRBACRpcInterface;
use App\Authorization\Application\RBACApplication;

/**
 * @\Swoft\Rpc\Server\Annotation\Mapping\Service()
 */
class RBACImpl implements OauthCenterRBACRpcInterface
{
    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var RBACApplication
     */
    protected RBACApplication $application;

    /**
     * Gets the roles that a user has.
     *
     * @param string $name
     * @param string ...$domain
     *
     * @return string[]
     */
    public function getRolesForUser(string $name, string ...$domain): array
    {
        return $this->application->getRolesForUserProvider($name, ...$domain);
    }

    /**
     * Gets the users that has a role.
     *
     * @param string $name
     * @param string ...$domain
     *
     * @return string[]
     */
    public function getUsersForRole(string $name, string ...$domain): array
    {
        return $this->application->getUsersForRoleProvider($name, ...$domain);
    }

    /**
     * Determines whether a user has a role.
     *
     * @param string $name
     * @param string $role
     * @param string ...$domain
     *
     * @return bool
     */
    public function hasRoleForUser(string $name, string $role, string ...$domain): bool
    {
        return $this->application->hasRoleForUserProvider($name, $role, ...$domain);
    }

    /**
     * Adds a role for a user.
     * returns false if the user already has the role (aka not affected).
     *
     * @param string $user
     * @param string $role
     * @param string ...$domain
     *
     * @return bool
     */
    public function addRoleForUser(string $user, string $role, string ...$domain): bool
    {
        return $this->application->addRoleForUserProvider($user, $role, ...$domain);
    }

    /**
     * @param string   $user
     * @param string[] $roles
     * @param string   ...$domain
     *
     * @return bool
     */
    public function addRolesForUser(string $user, array $roles, string ...$domain): bool
    {
        return $this->application->addRolesForUserProvider($user, $roles, ...$domain);
    }

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
    public function deleteRoleForUser(string $user, string $role, string ...$domain): bool
    {
        return $this->application->deleteRoleForUserProvider($user, $role, ...$domain);
    }

    /**
     * Deletes all roles for a user.
     * Returns false if the user does not have any roles (aka not affected).
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return bool
     */
    public function deleteRolesForUser(string $user, string ...$domain): bool
    {
        return $this->application->deleteRolesForUserProvider($user, ...$domain);
    }

    /**
     * Deletes a user.
     * Returns false if the user does not exist (aka not affected).
     *
     * @param string $user
     *
     * @return bool
     */
    public function deleteUser(string $user): bool
    {
        return $this->application->deleteUserProvider($user);
    }

    /**
     * Deletes a role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function deleteRole(string $role): bool
    {
        return $this->application->deleteRoleProvider($role);
    }

    /**
     * Deletes a permission.
     * Returns false if the permission does not exist (aka not affected).
     *
     * @param string ...$permission
     *
     * @return bool
     */
    public function deletePermission(string ...$permission): bool
    {
        return $this->application->deletePermissionProvider(...$permission);
    }

    /**
     * Adds a permission for a user or role.
     * Returns false if the user or role already has the permission (aka not affected).
     *
     * @param string $user
     * @param string ...$permission
     *
     * @return bool
     */
    public function addPermissionForUser(string $user, string ...$permission): bool
    {
        return $this->application->addPermissionForUserProvider($user, ...$permission);
    }

    /**
     * AddPermissionsForUser adds multiple permissions for a user or role.
     * Returns false if the user or role already has one of the permissions (aka not affected).
     *
     * @param string $user
     * @param array  ...$permissions
     *
     * @return bool
     */
    public function addPermissionsForUser(string $user, array ...$permissions): bool
    {
        return $this->application->addPermissionsForUserProvider($user, ...$permissions);
    }

    /**
     * Deletes a permission for a user or role.
     * Returns false if the user or role does not have the permission (aka not affected).
     *
     * @param string $user
     * @param string ...$permission
     *
     * @return bool
     */
    public function deletePermissionForUser(string $user, string ...$permission): bool
    {
        return $this->application->deletePermissionForUserProvider($user, ...$permission);
    }

    /**
     * Deletes permissions for a user or role.
     * Returns false if the user or role does not have any permissions (aka not affected).
     *
     * @param string $user
     *
     * @return bool
     */
    public function deletePermissionsForUser(string $user): bool
    {
        return $this->application->deletePermissionsForUserProvider($user);
    }

    /**
     * Gets permissions for a user or role.
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return array
     */
    public function getPermissionsForUser(string $user, string ...$domain): array
    {
        return $this->application->getPermissionsForUserProvider($user, ...$domain);
    }

    /**
     * Determines whether a user has a permission.
     *
     * @param string $user
     * @param string ...$permission
     *
     * @return bool
     */
    public function hasPermissionForUser(string $user, string ...$permission): bool
    {
        return $this->application->hasPermissionForUserProvider($user, ...$permission);
    }

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
    public function getImplicitRolesForUser(string $name, string ...$domain): array
    {
        return $this->application->getImplicitRolesForUserProvider($name, ...$domain);
    }

    /**
     * GetImplicitUsersForRole gets implicit users for a role.
     *
     * @param string $name
     * @param string ...$domain
     *
     * @return array
     */
    public function getImplicitUsersForRole(string $name, string ...$domain): array
    {
        return $this->application->getImplicitUsersForRoleProvider($name, ...$domain);
    }

    /**
     * GetImplicitResourcesForUser returns all policies that user obtaining in domain
     *
     * @param string $user
     * @param string ...$domain
     *
     * @return array
     */
    public function getImplicitResourcesForUser(string $user, string ...$domain): array
    {
        return $this->application->getImplicitResourcesForUserProvider($user, ...$domain);
    }

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
    public function getImplicitPermissionsForUser(string $user, string ...$domain): array
    {
        return $this->application->getImplicitPermissionsForUserProvider($user, ...$domain);
    }

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
    public function getImplicitUsersForPermission(string ...$permission): array
    {
        return $this->application->getImplicitUsersForPermissionProvider(...$permission);
    }

    /**
     * GetAllUsersByDomain would get all users associated with the domain.
     *
     * @param string $domain
     *
     * @return string[]
     */
    public function getAllUsersByDomain(string $domain): array
    {
        return $this->application->getAllUsersByDomainProvider($domain);
    }

    /**
     * Gets the users that has a role inside a domain. Add by Gordon.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getUsersForRoleInDomain(string $name, string $domain): array
    {
        return $this->application->getUsersForRoleInDomainProvider($name, $domain);
    }

    /**
     * Gets the roles that a user has inside a domain.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getRolesForUserInDomain(string $name, string $domain): array
    {
        return $this->application->getRolesForUserInDomainProvider($name, $domain);
    }

    /**
     * Gets permissions for a user or role inside a domain.
     *
     * @param string $name
     * @param string $domain
     *
     * @return array
     */
    public function getPermissionsForUserInDomain(string $name, string $domain): array
    {
        return $this->application->getPermissionsForUserInDomainProvider($name, $domain);
    }

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
    public function addRoleForUserInDomain(string $user, string $role, string $domain): bool
    {
        return $this->application->addRoleForUserInDomainProvider($user, $role, $domain);
    }

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
    public function deleteRoleForUserInDomain(string $user, string $role, string $domain): bool
    {
        return $this->application->deleteRoleForUserInDomainProvider($user, $role, $domain);
    }

    /**
     * DeleteAllUsersByDomain would delete all users associated with the domain.
     *
     * @param string $domain
     *
     * @return bool
     */
    public function deleteAllUsersByDomain(string $domain): bool
    {
        return $this->application->deleteAllUsersByDomainProvider($domain);
    }

    /**
     * DeleteDomains would delete all associated users and roles.
     * It would delete all domains if parameter is not provided.
     *
     * @param string ...$domains
     *
     * @return bool
     */
    public function deleteDomains(string ...$domains) : bool
    {
        return $this->application->deleteDomainsProvider(...$domains);
    }
}
