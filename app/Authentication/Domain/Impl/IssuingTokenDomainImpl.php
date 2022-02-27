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

use App\Authentication\Domain\Aggregate\Enum\IssuingToken;
use App\Authentication\Domain\IssuingTokenDomain;
use DateTimeImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token\Plain;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class IssuingTokenDomainImpl implements IssuingTokenDomain
{
    /**
     * 客服
     *
     * @var string
     */
    public string $customer = '';

    /**
     * @var int
     */
    public int $customerId = 0;

    /**
     * 昵称
     *
     * @var string
     */
    public string $nickname = '';

    /**
     * 公众号的id
     *
     * @var int
     */
    public int $platformId = 0;

    /**
     * 企业
     *
     * @var int
     */
    public int $enterpriseId = 0;

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     */
    public function setCustomer(string $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return int
     */
    public function getPlatformId(): int
    {
        return $this->platformId;
    }

    /**
     * @param int $platformId
     */
    public function setPlatformId(int $platformId): void
    {
        $this->platformId = $platformId;
    }

    /**
     * 获取 Token 配置
     *
     * @return \Lcobucci\JWT\Configuration
     */
    public function configuration(): Configuration
    {
        return Configuration::forAsymmetricSigner(
        // You may use RSA or ECDSA and all their variations (256, 384, and 512) and EdDSA over Curve25519
            new Sha256(),
            InMemory::file(__DIR__ . '/../../../../app-private-key.pem'),
            InMemory::base64Encoded(IssuingToken::BASE_64_ENCODE)
        // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
        );
    }

    /**
     * 生成 Token
     *
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $jti
     * @param string                      $username
     * @param string                      $exp
     *
     * @return \Lcobucci\JWT\Token\Plain
     */
    public function build(Configuration $config, string $jti, string $username, string $exp = '+7 day'): Plain
    {
        /**
         *  iss (Issuer) 签发人，即签发该 Token 的主体
         *
         * - sub (Subject) 主题，即描述该 Token 的用途
         *
         * - aud (Audience) 作用域，即描述这个 Token 是给谁用的，多个的情况下该属性值为一个字符串数组，单个则为一个字符串
         *
         * - exp (Expiration Time) 过期时间，即描述该 Token 在何时失效
         *
         * - nbf (Not Before) 生效时间，即描述该 Token 在何时生效
         *
         * - iat (Issued At) 签发时间，即描述该 Token 在何时被签发的
         *
         * - jti (JWT ID) 唯一标识
         */

        $now   = new DateTimeImmutable();
        $token = $config->builder()
            // Configures the issuer (iss claim)
            ->issuedBy(IssuingToken::ISSUER)
            // Configures the audience (aud claim)
            ->permittedFor(IssuingToken::AUDIENCE)
            // Configures the id (jti claim)
            ->identifiedBy($jti)
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify(IssuingToken::NOT_BEFORE))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify($exp))
            // Configures a new claim, called "username"
            ->withClaim('username', $username);
        // Configures a new header, called "foo"
        // ->withHeader('foo', 'bar')

        if ($this->getCustomer()) {
            $token->withClaim('customer', $this->getCustomer());
        }

        if ($this->getCustomerId()) {
            $token->withClaim('customerId', $this->getCustomerId());
        }

        if ($this->getNickname()) {
            $token->withClaim('customerId', $this->getNickname());
        }

        if ($this->getPlatformId()) {
            $token->withClaim('platformId', $this->getPlatformId());
        }

        if ($this->getEnterpriseId()) {
            $token->withClaim('enterpriseId', $this->getEnterpriseId());
        }

        // Builds a new token
        return $token->getToken($config->signer(), $config->signingKey());
    }

    public function setEnterpriseId(int $enterPriseId): void
    {
        $this->enterpriseId = $enterPriseId;
    }

    public function getEnterpriseId(): int
    {
        return $this->enterpriseId;
    }
}
