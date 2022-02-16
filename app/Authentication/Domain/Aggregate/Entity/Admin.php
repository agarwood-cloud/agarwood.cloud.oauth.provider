<?php declare(strict_types=1);
/**
 * This file is part of Agarwood Cloud.
 *
 * @link     https://www.agarwood-cloud.com
 * @document https://www.agarwood-cloud.com/docs
 * @contact  676786620@qq.com
 * @author   agarwood
 */

namespace App\Authentication\Domain\Aggregate\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;

/**
 * 管理员
 * Class Admin
 *
 * @since 2.0
 *
 * @Entity(table="admin")
 */
class Admin extends Model
{
    /**
     *
     * @Column(name="enterprise_id", prop="enterpriseID")
     *
     * @var int
     */
    private int $enterpriseID = 0;

    /**
     *
     * @Column(name="created_at", prop="createdAt")
     *
     * @var string
     */
    private string $createdAt = '';

    /**
     *
     *
     * @Column(name="deleted_at", prop="deletedAt")
     *
     * @var string
     */
    private string $deletedAt = '';

    /**
     *
     *
     * @Column()
     *
     * @var string
     */
    private string $email = '';

    /**
     *
     * @Id()
     * @Column()
     *
     * @var int
     */
    private int $id = 0;

    /**
     *
     *
     * @Column(hidden=true)
     *
     * @var string
     */
    private string $password = '';

    /**
     *
     *
     * @Column()
     *
     * @var string
     */
    private string $phone = '';

    /**
     * usable:可用,disabled:不可用
     *
     * @Column()
     *
     * @var string
     */
    private string $status = '';

    /**
     *
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var string
     */
    private string $updatedAt = '';

    /**
     *
     *
     * @Column()
     *
     * @var string
     */
    private string $username = '';

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }

    /**
     * @param string $deletedAt
     */
    public function setDeletedAt(string $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

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
     * @return int
     */
    public function getEnterpriseID(): int
    {
        return $this->enterpriseID;
    }

    /**
     * @param int $enterpriseID
     */
    public function setEnterpriseID(int $enterpriseID): void
    {
        $this->enterpriseID = $enterpriseID;
    }
}
