<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Application\Impl;

use Agarwood\Core\Exception\BusinessException;
use Agarwood\Core\Exception\ForbiddenException;
use App\Authentication\Application\OAuthApplication;
use App\Authentication\Domain\ConfigurationDomain;
use App\Authentication\Domain\IssuingTokenDomain;
use App\Authentication\Domain\UserDomain;
use App\Authentication\Interfaces\DTO\LoginDTO;
use App\Authentication\Interfaces\DTO\SignupDTO;
use App\Authentication\Interfaces\Rpc\Client\CustomerRpcClient;

/**
 * @\Swoft\Bean\Annotation\Mapping\Bean()
 */
class OAuthApplicationImpl implements OAuthApplication
{
    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\UserDomain
     */
    public UserDomain $userDomain;

    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\ConfigurationDomain
     */
    public ConfigurationDomain $configurationDomain;

    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Domain\IssuingTokenDomain
     */
    public IssuingTokenDomain $issuingTokenDomain;

    /**
     * @\Swoft\Bean\Annotation\Mapping\Inject()
     *
     * @var \App\Authentication\Interfaces\Rpc\Client\CustomerRpcClient
     */
    public CustomerRpcClient $customerRpcClient;

    /**
     * 登陆
     *
     * @param \App\Authentication\Interfaces\DTO\LoginDTO $DTO
     *
     * @return array
     */
    public function userLoginProvider(LoginDTO $DTO): array
    {
        // 用户信息
        $user = $this->userDomain->getUser($DTO->getUsername());

        // 版本比较，版本必须大于 3.2.0 才可以正常使用
        // version_compare('3.2.0', $DTO->getVersion(), 'ge');

        // 验证账号密码是否正确
        if ($user && password_verify($DTO->getPassword(), $user['password'])) {

            // 配置token
            $config = $this->configurationDomain->forSymmetricSigner();

            // 设置企业id
            $this->issuingTokenDomain->setEnterpriseId($user['enterprise_id']);

            // 生成token
            $build = $this->issuingTokenDomain->build($config, (string)$user['id'], $user['username']);

            // 不显示在前端
            unset($user['password']);
            return array_merge($user, ['token' => $build->toString()]);
        }

        throw new ForbiddenException('Account or password failed to be verified！');
    }

    /**
     * 退出
     *
     * @return bool
     */
    public function userLogoutProvider(): bool
    {
        // todo 退出系统的一些操作
        return false;
    }

    /**
     * 注册
     *
     * @param \App\Authentication\Interfaces\DTO\SignupDTO $DTO
     *
     * @return bool
     */
    public function userSignupProvider(SignupDTO $DTO): bool
    {
        // 判断是否存在值
        $user = $this->userDomain->getUser($DTO->getUsername());

        if ($user) {
            throw new BusinessException('Account already exists！');
        }

        return $this->userDomain->signup($DTO->getUsername(), $DTO->getPassword());
    }

    /**
     * @param \App\Authentication\Interfaces\DTO\SignupDTO $DTO
     *
     * @return array
     */
    public function customerSignupProvider(SignupDTO $DTO): array
    {
        // customer service info
        $customer = $this->customerRpcClient->login($DTO->getPlatformId(), $DTO->getUsername());

        // 验证通过
        if ($customer && password_verify($DTO->getPassword(), $customer['password'])) {

            // 配置token
            $config = $this->configurationDomain->forSymmetricSigner();

            // 加入更多的参数
            $this->issuingTokenDomain->setCustomer($customer['account']);
            $this->issuingTokenDomain->setCustomerId($customer['id']);
            $this->issuingTokenDomain->setPlatformId($customer['platformId']);
            $this->issuingTokenDomain->setEnterpriseId($customer['enterpriseId']);

            // 生成token
            $build = $this->issuingTokenDomain->build($config, (string)$customer['id'], $customer['name']);

            // 不显示在前端
            unset($customer['password']);
            return array_merge($customer, ['token' => $build->toString()]);
        }
        // jwt
        throw new ForbiddenException('Account or password failed to be verified！');
    }
}
