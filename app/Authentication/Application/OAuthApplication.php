<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Application;

use App\Authentication\Interfaces\DTO\LoginDTO;
use App\Authentication\Interfaces\DTO\SignupDTO;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface OAuthApplication
{
    /**
     * @param \App\Authentication\Interfaces\DTO\LoginDTO $DTO
     *
     * @return array
     */
    public function userLoginProvider(LoginDTO $DTO): array;

    /**
     * @return bool
     */
    public function userLogoutProvider(): bool;

    /**
     * @param \App\Authentication\Interfaces\DTO\SignupDTO $DTO
     *
     * @return bool
     */
    public function userSignupProvider(SignupDTO $DTO): bool;
}
