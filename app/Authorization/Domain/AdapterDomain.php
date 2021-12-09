<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Domain;

use Casbin\Enforcer;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
interface AdapterDomain
{
    /**
     * Below shows how to initialize an enforcer from the built-in mysql adapter
     *
     * @return \Casbin\Enforcer
     */
    public function enforcer(): Enforcer;
}
