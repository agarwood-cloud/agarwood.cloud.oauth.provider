<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Infrastraucture\Repository;

use App\Authentication\Domain\Aggregate\Entity\Admin;
use App\Authentication\Domain\Aggregate\Enum\UserStatus;
use App\Authentication\Domain\Aggregate\Repository\UserQueryRepository;
use Swoft\Db\DB;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class UserQueryRepositoryImpl implements UserQueryRepository
{
    /**
     * 获取用户信息
     *
     * @param string $username
     *
     * @return array
     */
    public function getUser(string $username): array
    {
        return DB::table(Admin::tableName())
            ->select(
                'id',
                'username',
                'phone',
                'email',
                'password',
                'status',
                'created_at as createdAt',
                'updated_at as updatedAt',
                'deleted_at as deletedAt',
            )
            ->where('username', '=', $username)
            ->where('status', '=', UserStatus::STATUS_USABLE)
            ->firstArray();
    }
}
