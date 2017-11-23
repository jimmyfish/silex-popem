<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 20/11/17
 * Time: 17:57
 */

namespace Silex\Api\Domain\Repository;


use Doctrine\ORM\EntityRepository;
use Silex\Api\Domain\Contracts\Repository\UserRepositoryInterface;
use Silex\Api\Domain\Entity\User;

class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface
{

    /**
     * @param $id
     * @return User
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * @param $username
     * @return User
     */
    public function findByUsername($username)
    {
        return $this->findOneBy(['username'=>$username]);
    }
}