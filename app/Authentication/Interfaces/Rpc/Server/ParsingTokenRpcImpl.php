<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Interfaces\Rpc\Server;

use Agarwood\Rpc\OauthCenter\OAuthCenterJWTRpcInterface;
use App\Authentication\Domain\ConfigurationDomain;
use App\Authentication\Domain\ParsingTokenDomain;
use App\Authentication\Domain\ValidatingTokenDomain;
use function context;

/**
 * @\Swoft\Rpc\Server\Annotation\Mapping\Service()
 */
class ParsingTokenRpcImpl implements OAuthCenterJWTRpcInterface
{
    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\ConfigurationDomain
     */
    public ConfigurationDomain $configurationDomain;

    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\ParsingTokenDomain
     */
    public ParsingTokenDomain $parsingTokenDomain;

    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\ValidatingTokenDomain
     */
    public ValidatingTokenDomain $validatingTokenDomain;

    /**
     * 验证token是否可用
     *
     * @param string|null $token
     *
     * @return bool
     */
    public function validator(?string $token): bool
    {
        if (empty($token)) {
            $token = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }

        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->validatingTokenDomain->assert($config, $token);
    }

    /**
     * 用户id 或者 粉丝openid
     *
     * @param string|null $parse
     *
     * @return int|string|null
     */
    public function getUserId(?string $parse): int|string|null
    {
        if (empty($parse)) {
            $parse = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }
        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->parsingTokenDomain->getUserId($config, $parse);
    }

    /**
     * @param string|null $parse
     *
     * @return string|null
     */
    public function getCustomer(?string $parse): string|null
    {
        if (empty($parse)) {
            $parse = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }
        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->parsingTokenDomain->getCustomer($config, $parse);
    }

    /**
     * @param string|null $parse
     *
     * @return int|null
     */
    public function getCustomerId(?string $parse): int|null
    {
        if (empty($parse)) {
            $parse = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }
        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->parsingTokenDomain->getCustomerId($config, $parse);
    }

    /**
     * @param string|null $parse
     *
     * @return string|null
     */
    public function getNickname(?string $parse): string|null
    {
        if (empty($parse)) {
            $parse = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }
        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->parsingTokenDomain->getNickname($config, $parse);
    }

    /**
     * @param string|null $parse
     *
     * @return int|null
     */
    public function getPlatformId(?string $parse): int|null
    {
        if (empty($parse)) {
            $parse = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }
        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->parsingTokenDomain->getPlatformId($config, $parse);
    }

    /**
     * @param string|null $parse
     *
     * @return string|null
     */
    public function getEnterPriseId(?string $parse): string|null
    {
        if (empty($parse)) {
            $parse = str_replace('Bearer ', '', context()->getRequest()->getHeaderLine('Authorization'));
        }
        $config = $this->configurationDomain->forSymmetricSigner();

        return $this->parsingTokenDomain->getEnterPriseId($config, $parse);
    }
}
