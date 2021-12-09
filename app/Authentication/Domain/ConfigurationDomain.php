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
use Lcobucci\JWT\Decoder;
use Lcobucci\JWT\Encoder;

/**
 * Configuration initialisation
 *
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface ConfigurationDomain
{
    /**
     * Configuration initialisation
     *
     * @param \Lcobucci\JWT\Encoder|null $encoder
     * @param \Lcobucci\JWT\Decoder|null $decoder
     *
     * @return \Lcobucci\JWT\Configuration
     */
    public function forSymmetricSigner(?Encoder $encoder = null, ?Decoder $decoder = null): Configuration;
}
