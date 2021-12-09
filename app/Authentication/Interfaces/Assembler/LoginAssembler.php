<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Interfaces\Assembler;

use App\Authentication\Interfaces\DTO\LoginDTO;
use App\Authentication\Interfaces\DTO\SignupDTO;
use Swoft\Stdlib\Helper\ObjectHelper;

class LoginAssembler
{
    /**
     * @param array $attributes
     *
     * @return \App\Authentication\Interfaces\DTO\LoginDTO
     */
    public static function attributesToLoginDTO(array $attributes): LoginDTO
    {
        return ObjectHelper::init(new LoginDTO(), $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \App\Authentication\Interfaces\DTO\SignupDTO
     */
    public static function attributesToSignupDTO(array $attributes): SignupDTO
    {
        return ObjectHelper::init(new SignupDTO(), $attributes);
    }
}
