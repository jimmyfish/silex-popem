<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 22/11/17
 * Time: 16:53
 */

namespace Silex\Api\Domain\Repository;


use Doctrine\ORM\EntityRepository;
use Silex\Api\Domain\Contracts\Repository\CategoryRepositoryInterface;
use Silex\Api\Domain\Entity\Category;

class DoctrineCategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{

    /**
     * @param $id
     * @return Category
     */
    public function findById($id)
    {
        return $this->find($id);
    }
}