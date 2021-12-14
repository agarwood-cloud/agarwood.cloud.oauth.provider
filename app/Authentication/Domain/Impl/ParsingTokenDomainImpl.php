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

use App\Authentication\Domain\ParsingTokenDomain;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\UnencryptedToken;

/**
 * Parsing tokens
 *
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class ParsingTokenDomainImpl implements ParsingTokenDomain
{
    /**
     * 用户id 或者 粉丝openid
     *
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return int|string|null
     */
    public function getUserId(Configuration $config, string $parse): int|string|null
    {
        $token = $config->parser()->parse($parse);
        assert($token instanceof UnencryptedToken);
        return $token->claims()->get('jti');
    }

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return string|null
     */
    public function getCustomer(Configuration $config, string $parse): string|null
    {
        $token = $config->parser()->parse($parse);
        assert($token instanceof UnencryptedToken);
        return $token->claims()->get('customer');
    }

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return int|null
     */
    public function getCustomerId(Configuration $config, string $parse): int|null
    {
        $token = $config->parser()->parse($parse);
        assert($token instanceof UnencryptedToken);
        return $token->claims()->get('customerId');
    }

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return string|null
     */
    public function getNickname(Configuration $config, string $parse): string|null
    {
        $token = $config->parser()->parse($parse);
        assert($token instanceof UnencryptedToken);
        return $token->claims()->get('nickname');
    }

    /**
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return int|null
     */
    public function getOfficialAccountId(Configuration $config, string $parse): int|null
    {
        $token = $config->parser()->parse($parse);
        assert($token instanceof UnencryptedToken);
        return $token->claims()->get('officialAccountId');
    }
}
