<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Interfaces\Assembler;

use App\Authorization\Interfaces\DTO\PermissionDTO;
use App\Authorization\Interfaces\DTO\RoleDTO;
use App\Authorization\Interfaces\DTO\UserDTO;
use App\Authorization\Interfaces\DTO\UserPermissionDTO;
use App\Authorization\Interfaces\DTO\UserPermissionsDTO;
use App\Authorization\Interfaces\DTO\UserRoleDTO;
use Swoft\Stdlib\Helper\ObjectHelper;

class OAuthAssembler
{
    /**
     * @param array $attributes
     *
     * @return \App\Authorization\Interfaces\DTO\UserDTO
     */
    public static function attributesToUserDTO(array $attributes): UserDTO
    {
        return ObjectHelper::init(new UserDTO(), $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \App\Authorization\Interfaces\DTO\RoleDTO
     */
    public static function attributesToRoleDTO(array $attributes): RoleDTO
    {
        return ObjectHelper::init(new RoleDTO(), $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \App\Authorization\Interfaces\DTO\UserRoleDTO
     */
    public static function attributesToUserRoleDTO(array $attributes): UserRoleDTO
    {
        return ObjectHelper::init(new UserRoleDTO(), $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \App\Authorization\Interfaces\DTO\PermissionDTO
     */
    public static function attributesToPermissionDTO(array $attributes): PermissionDTO
    {
        return ObjectHelper::init(new PermissionDTO(), $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \App\Authorization\Interfaces\DTO\UserPermissionDTO
     */
    public static function attributesToUserPermissionDTO(array $attributes): UserPermissionDTO
    {
        return ObjectHelper::init(new UserPermissionDTO(), $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \App\Authorization\Interfaces\DTO\UserPermissionsDTO
     */
    public static function attributesToUserPermissionsDTO(array $attributes): UserPermissionsDTO
    {
        return ObjectHelper::init(new UserPermissionsDTO(), $attributes);
    }
}
