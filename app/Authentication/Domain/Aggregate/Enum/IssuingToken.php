<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Domain\Aggregate\Enum;

class IssuingToken
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

    /**
     * private key
     */
    public const BASE_64_ENCODE = 'WVNCMlpYSjVJR3h2Ym1jZ1lTQjJaWEo1SUhWc2RISmhJSE5sWTNWeVpTQnJaWGtnWm05eUlHMTVJR0Z0WVhwcGJtY2dkRzlyWlc1eg==';

    public const ISSUER = 'agarwood';

    public const SUBJECT = 'admin';

    public const NOT_BEFORE = '+1 second';

    public const AUDIENCE = 'https://www.agarwood-cloud.com';
}
