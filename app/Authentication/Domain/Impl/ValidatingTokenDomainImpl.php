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
use App\Authentication\Domain\ValidatingTokenDomain;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\IdentifiedBy;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class ValidatingTokenDomainImpl implements ValidatingTokenDomain
{
    /**
     * Validating tokens
     *
     * @param \Lcobucci\JWT\Configuration $config
     * @param string                      $parse
     *
     * @return bool
     */
    public function assert(Configuration $config, string $parse): bool
    {
        $token = $config->parser()->parse($parse);

        assert($token instanceof UnencryptedToken);

        $id = $token->claims()->get('jti');

        // 增加验证器
        $config->setValidationConstraints(...[

            new IdentifiedBy($id),

            //verifies if the claim iss is listed as expected values
            new IssuedBy(IssuingToken::ISSUER),

            // verifies if the claim aud contains the expected value
            // new PermittedFor(),

            // verifies if the claim sub matches the expected value
            // new RelatedTo(),

            // verifies if the token was signed with the expected signer and key
            new SignedWith($config->signer(), InMemory::file(__DIR__ . '/../../../../app-public-key.key')),

            //verifies the claims iat, nbf, and exp (supports leeway configuration)
            new LooseValidAt(SystemClock::fromSystemTimezone()),
        ]);

        $constraints = $config->validationConstraints();

        // only one constraint is required to be valid
        return $config->validator()->validate($token, ...$constraints);
    }
}
