<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 20/11/17
 * Time: 17:56
 */

namespace Silex\Api\Domain\Entity;

/**
 * Class User
 * @package Silex\Api\Domain\Entity
 * @Entity(repositoryClass="Silex\Api\Domain\Repository\DoctrineUserRepository")
 * @HasLifecycleCallbacks
 * @Table(name="user")
 */
class User
{
    /**
     * @var int
     * @Column(type="integer",nullable=false)
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @Column(type="string",length=255,nullable=false)
     */
    private $username;

    /**
     * @var string
     * @Column(type="string",length=255,nullable=false)
     */
    private $password;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }


}