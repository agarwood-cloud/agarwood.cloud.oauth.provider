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
 * Validating tokens
 *
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface ValidatingTokenDomain
{
    /**
     * Validating tokens
     *
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return bool
     */
    public function assert(Configuration $config, string $parse): bool;
}
