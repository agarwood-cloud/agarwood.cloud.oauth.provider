<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Domain\Impl;

use App\Authorization\Domain\AdapterDomain;
use App\Authorization\Domain\UserDomain;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class UserDomainImpl implements UserDomain
{
    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authorization\Domain\AdapterDomain
     */
    protected AdapterDomain $adapterDomain;

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
        return $this->adapterDomain->enforcer()->getUsersForRole($name, ...$domain);
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
        return $this->adapterDomain->enforcer()->deleteUser($user);
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
        return $this->adapterDomain->enforcer()->getImplicitUsersForRole($name, ...$domain);
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
        return $this->adapterDomain->enforcer()->getImplicitResourcesForUser($user, ...$domain);
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
     * @throws \Casbin\Exceptions\CasbinException
     */
    public function getImplicitUsersForPermission(string ...$permission): array
    {
        return $this->adapterDomain->enforcer()->getImplicitUsersForPermission(...$permission);
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
        return $this->adapterDomain->enforcer()->getAllUsersByDomain($domain);
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
        return $this->adapterDomain->enforcer()->getUsersForRoleInDomain($name, $domain);
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
        return $this->adapterDomain->enforcer()->deleteAllUsersByDomain($domain);
    }
}
