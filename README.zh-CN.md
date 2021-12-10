### 概述

OAuth 是 Agarwood 的一部分，为Agarwood提供强大的、高效的开源访问控制，
目前仅支持RBAC，但可以简单的扩展支持主流的ABAC、ACL等访问控制


### 环境要求

- PHP 8.0
- Swoole 8.4.1+
- Composer

### 安装

```shell
git clone git@github.com:agarwood-cloud/agarwood.cloud.oauth.provider.git

composer install
```

### 配置

- 数据库链接、RPC、Redis等详细配置请看.env文件
- JWT使用Sha256加密方式，详细配置请看app-private-key.pen、app-public-key.key

### 运行

```shell
php bin/swoft http:start
```

### 开源许可

Agarwood is an open-source software licensed under the [LICENSE](LICENSE)
