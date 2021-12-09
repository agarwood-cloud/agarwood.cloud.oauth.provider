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
use App\Authentication\Domain\ConfigurationDomain;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Decoder;
use Lcobucci\JWT\Encoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class ConfigurationDomainImpl implements ConfigurationDomain
{
    /**
     * Configuration initialisation
     *
     * @param \Lcobucci\JWT\Encoder|null $encoder
     * @param \Lcobucci\JWT\Decoder|null $decoder
     *
     * @return \Lcobucci\JWT\Configuration
     */
    public function forSymmetricSigner(?Encoder $encoder = null, ?Decoder $decoder = null): Configuration
    {
        return Configuration::forAsymmetricSigner(
        // You may use RSA or ECDSA and all their variations (256, 384, and 512) and EdDSA over Curve25519
            new Sha256(),
            InMemory::file(__DIR__ . '/../../../../app-private-key.pem'),
            InMemory::base64Encoded(IssuingToken::BASE_64_ENCODE)
        // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
        );
    }
}
