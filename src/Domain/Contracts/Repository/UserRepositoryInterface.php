<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 20/11/17
 * Time: 18:10
 */

namespace Silex\Api\Domain\Contracts\Repository;


use Silex\Api\Domain\Entity\User;

interface UserRepositoryInterface
{

    /**
     * @param $id
     * @return User
     */
    public function findById($id);

    /**
     * @param $username
     * @return User
     */
    public function findByUsername($username);

}