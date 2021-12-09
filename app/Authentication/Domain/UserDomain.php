<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Domain;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface UserDomain
{
    /**
     * 用户信息
     *
     * @param string $username
     *
     * @return array
     */
    public function getUser(string $username): array;

    /**
     * 注册
     *
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function signup(string $username, string $password): bool;
}
