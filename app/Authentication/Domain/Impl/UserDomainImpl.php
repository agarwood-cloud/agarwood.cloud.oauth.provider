<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Domain\Impl;

use App\Authentication\Domain\Aggregate\Repository\UserCommandRepository;
use App\Authentication\Domain\Aggregate\Repository\UserQueryRepository;
use App\Authentication\Domain\UserDomain;
use Godruoyi\Snowflake\Snowflake;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class UserDomainImpl implements UserDomain
{
    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\Aggregate\Repository\UserQueryRepository
     */
    public UserQueryRepository $userQueryRepository;

    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\Aggregate\Repository\UserCommandRepository
     */
    public UserCommandRepository $userCommandRepository;

    /**
     * 获取用户信息
     *
     * @param string $username
     *
     * @return array
     */
    public function getUser(string $username): array
    {
        return $this->userQueryRepository->getUser($username);
    }

    /**
     * 注册
     *
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function signup(string $username, string $password): bool
    {
        // 雪花id
        $snowflake  = new Snowflake();
        $attributes = [
            'id'       => (int)$snowflake->id(),
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        return $this->userCommandRepository->signup($attributes);
    }
}
