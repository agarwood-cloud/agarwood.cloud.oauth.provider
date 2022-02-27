<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Interfaces\Rpc\Client\Impl;

use Agarwood\Rpc\UserCenter\UserCenterCustomerRpcInterface;
use App\Authentication\Interfaces\Rpc\Client\CustomerRpcClient;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class CustomerRpcClientImpl implements CustomerRpcClient
{
    /**
     * @Reference(pool="user.center.pool")
     *
     * @var \Agarwood\Rpc\UserCenter\UserCenterCustomerRpcInterface
     */
    public UserCenterCustomerRpcInterface $userCenterCustomerRpc;

    /**
     * Customer Service Login
     *
     * @param int    $platformId
     * @param string $username
     *
     * @return array
     */
    public function login(int $platformId, string $username): array
    {
        return $this->userCenterCustomerRpc->login($platformId, $username);
    }
}
