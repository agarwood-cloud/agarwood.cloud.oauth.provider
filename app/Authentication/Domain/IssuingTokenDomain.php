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
use Lcobucci\JWT\Token\Plain;

/**
 * Issuing tokens
 *
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface IssuingTokenDomain
{
    /**
     * @return string
     */
    public function getCustomer(): string;

    /**
     * @param string $customer
     */
    public function setCustomer(string $customer): void;

    /**
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void;

    /**
     * @return string
     */
    public function getNickname(): string;

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): void;

    /**
     * @return int
     */
    public function getOfficialAccountId(): int;

    /**
     * @param int $officialAccountId
     */
    public function setOfficialAccountId(int $officialAccountId): void;

    /**
     * Issuing tokens
     *
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $jti
     * @param string                      $username
     * @param string                      $exp
     *
     * @return Plain
     */
    public function build(Configuration $config, string $jti, string $username, string $exp = '+7 day'): Plain;
}
