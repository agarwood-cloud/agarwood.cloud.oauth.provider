<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Interfaces\DTO;

/**
 * @\Swoft\Validator\Annotation\Mapping\Validator()
 */
class SignupDTO
{
    /**
     * 用户名
     *
     * @\Swoft\Validator\Annotation\Mapping\Required()
     * @\Swoft\Validator\Annotation\Mapping\NotEmpty()
     * @\Swoft\Validator\Annotation\Mapping\IsString()
     *
     * @var string
     */
    public string $username = '';

    /**
     * 密码
     *
     * @\Swoft\Validator\Annotation\Mapping\Required()
     * @\Swoft\Validator\Annotation\Mapping\NotEmpty()
     * @\Swoft\Validator\Annotation\Mapping\IsString()
     *
     * @var string
     */
    public string $password = '';


    /**
     * @\Swoft\Validator\Annotation\Mapping\IsInt()
     *
     * @var int
     */
    public int $officialAccountId = 0;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getOfficialAccountId(): int
    {
        return $this->officialAccountId;
    }

    /**
     * @param int $officialAccountId
     */
    public function setOfficialAccountId(int $officialAccountId): void
    {
        $this->officialAccountId = $officialAccountId;
    }
}
