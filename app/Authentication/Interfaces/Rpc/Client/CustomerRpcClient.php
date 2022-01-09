<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Interfaces\Rpc\Client;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface CustomerRpcClient
{
    /**
     * Customer Service Login
     *
     * @param int    $officialAccountId
     * @param string $username
     *
     * @return array
     */
    public function login(int $officialAccountId, string $username): array;
}
