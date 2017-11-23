<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 22/11/17
 * Time: 16:53
 */

namespace Silex\Api\Domain\Contracts\Repository;


use Silex\Api\Domain\Entity\Category;

interface CategoryRepositoryInterface
{

    /**
     * @param $id
     * @return Category
     */
    public function findById($id);

}