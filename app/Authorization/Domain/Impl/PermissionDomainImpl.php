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
use App\Authorization\Domain\PermissionDomain;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class PermissionDomainImpl implements PermissionDomain
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
    public function deletePermission(string ...$permission): bool
    {
        return $this->adapterDomain->enforcer()->deletePermission(...$permission);
    }

    /**
     * @inheritDoc
     */
    public function addPermissionForUser(string $user, string ...$permission): bool
    {
        return $this->adapterDomain->enforcer()->addPermissionForUser($user, ...$permission);
    }

    /**
     * @inheritDoc
     */
    public function addPermissionsForUser(string $user, array ...$permissions): bool
    {
        return $this->adapterDomain->enforcer()->addPermissionsForUser($user, ...$permissions);
    }

    /**
     * @inheritDoc
     */
    public function deletePermissionForUser(string $user, string ...$permission): bool
    {
        return $this->adapterDomain->enforcer()->deletePermissionForUser($user, ...$permission);
    }

    /**
     * @inheritDoc
     */
    public function deletePermissionsForUser(string $user): bool
    {
        return $this->adapterDomain->enforcer()->deletePermissionsForUser($user);
    }

    /**
     * @inheritDoc
     */
    public function getPermissionsForUser(string $user, string ...$domain): array
    {
        return $this->adapterDomain->enforcer()->getPermissionsForUser($user, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function hasPermissionForUser(string $user, string ...$permission): bool
    {
        return $this->adapterDomain->enforcer()->hasPermissionForUser($user, ...$permission);
    }

    /**
     * @inheritDoc
     * @throws \Casbin\Exceptions\CasbinException
     */
    public function getImplicitPermissionsForUser(string $user, string ...$domain): array
    {
        return $this->adapterDomain->enforcer()->getImplicitPermissionsForUser($user, ...$domain);
    }

    /**
     * @inheritDoc
     */
    public function getPermissionsForUserInDomain(string $name, string $domain): array
    {
        return $this->adapterDomain->enforcer()->getPermissionsForUserInDomain($name, $domain);
    }

    /**
     * @inheritDoc
     */
    public function deleteDomains(string ...$domains): bool
    {
        return $this->adapterDomain->enforcer()->deleteDomains(...$domains);
    }
}
