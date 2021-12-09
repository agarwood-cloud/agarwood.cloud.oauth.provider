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
use App\Authentication\Domain\Aggregate\Repository\UserCommandRepository;
use Swoft\Db\DB;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class UserCommandRepositoryImpl implements UserCommandRepository
{
    /**
     * 注册
     *
     * @param array $attributes
     *
     * @return bool
     */
    public function signup(array $attributes): bool
    {
        return DB::table(Admin::tableName())
            ->insert($attributes);
    }
}
