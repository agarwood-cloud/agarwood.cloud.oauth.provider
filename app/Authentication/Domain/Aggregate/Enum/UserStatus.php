<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Domain\Aggregate\Enum;

class UserStatus
{
    /**
     * 账号可用状态
     */
    public const STATUS_USABLE = 'usable';

    /**
     * 账号不可用状态
     */
    public const STATUS_DISABLED = 'disabled';
}
