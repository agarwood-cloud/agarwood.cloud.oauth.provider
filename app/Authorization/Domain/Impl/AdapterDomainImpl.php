<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authorization\Domain\Impl;

use App\Authorization\Domain\AdapterDomain;
use Casbin\Enforcer;
use CasbinAdapter\DBAL\Adapter;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class AdapterDomainImpl implements AdapterDomain
{
    /**
     * Below shows how to initialize an enforcer from the built-in mysql adapter
     *
     * @return \Casbin\Enforcer
     * @throws \Doctrine\DBAL\Exception
     * @throws \Casbin\Exceptions\CasbinException
     */
    public function enforcer(): Enforcer
    {
        $config = [
            // Either 'driver' with one of the following values:
            // pdo_mysql,pdo_sqlite,pdo_pgsql,pdo_oci (unstable),pdo_sqlsrv,pdo_sqlsrv,
            // mysqli,sqlanywhere,sqlsrv,ibm_db2 (unstable),drizzle_pdo_mysql
            'driver'   => 'pdo_mysql',
            'host'     => env('MASTER_DB_HOST', '127.0.0.1'),
            'dbname'   => env('MASTER_DB_NAME', 'agarwood.cloud.authorization.provider'),
            'user'     => env('MASTER_DB_USER', 'root'),
            'password' => env('MASTER_DB_PWD', 'root'),
            'port'     => env('MASTER_DB_PORT', '3306'),
        ];

        $adapter = Adapter::newAdapter($config);

        return new Enforcer(__DIR__ . '/../Config/model.conf', $adapter);
    }
}
