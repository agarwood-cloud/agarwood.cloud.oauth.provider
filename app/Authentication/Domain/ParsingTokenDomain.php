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

use Lcobucci\JWT\Configuration;

/**
 * Parsing tokens
 *
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface ParsingTokenDomain
{
    /**
     * 用户id 或者 粉丝openid
     *
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return int|string|null
     */
    public function getUserId(Configuration $config, string $parse): int|string|null;

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return string|null
     */
    public function getCustomer(Configuration $config, string $parse): string|null;

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return int|null
     */
    public function getCustomerId(Configuration $config, string $parse): int|null;

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return string|null
     */
    public function getNickname(Configuration $config, string $parse): string|null;

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return int|null
     */
    public function getPlatformId(Configuration $config, string $parse): int|null;

    public function getEnterPriseId(Configuration $config, array|string|null $parse): string|null;
}
