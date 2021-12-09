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
use App\Authorization\Domain\RoleDomain;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class RoleDomainImpl implements RoleDomain
{
    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authorization\Domain\AdapterDomain
     */
    protected AdapterDomain $adapterDomain;

    /**
     * @inheritDoc
     */
    public function getRolesForUser(string $name, string ...$domain): array
    {
        return $this->adapterDomain->enforcer()->getRolesForUser($name, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function hasRoleForUser(string $name, string $role, string ...$domain): bool
    {
        return $this->adapterDomain->enforcer()->hasRoleForUser($name, $role, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function addRoleForUser(string $user, string $role, string ...$domain): bool
    {
        return $this->adapterDomain->enforcer()->addRoleForUser($user, $role, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function addRolesForUser(string $user, array $roles, string ...$domain): bool
    {
        return $this->adapterDomain->enforcer()->addRoleForUser($user, $roles, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function deleteRoleForUser(string $user, string $role, string ...$domain): bool
    {
        return $this->adapterDomain->enforcer()->deleteRoleForUser($user, $role, ...$domain);
    }

    /**
     * @inheritDoc
     * @throws \Casbin\Exceptions\CasbinException
     */
    public function deleteRolesForUser(string $user, string ...$domain): bool
    {
        return $this->adapterDomain->enforcer()->deleteRolesForUser($user, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function deleteRole(string $role): bool
    {
        return $this->adapterDomain->enforcer()->deleteRole($role);
    }

    /**
     * @inheritDoc
     */
    public function getImplicitRolesForUser(string $name, string ...$domain): array
    {
        return $this->adapterDomain->enforcer()->getImplicitRolesForUser($name, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function getRolesForUserInDomain(string $name, string $domain): array
    {
        return $this->adapterDomain->enforcer()->getRolesForUserInDomain($name, $domain);
    }

    /**
     * @inheritDoc
     */
    public function addRoleForUserInDomain(string $user, string $role, string $domain): bool
    {
        return $this->adapterDomain->enforcer()->addRoleForUserInDomain($user, $role, $domain);
    }

    /**
     * @inheritDoc
     */
    public function deleteRoleForUserInDomain(string $user, string $role, string $domain): bool
    {
        return $this->adapterDomain->enforcer()->deleteRoleForUserInDomain($user, $role, $domain);
    }
}
