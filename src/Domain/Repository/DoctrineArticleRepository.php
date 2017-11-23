<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 21/11/17
 * Time: 17:11
 */

namespace Silex\Api\Domain\Repository;


use Doctrine\ORM\EntityRepository;
use Silex\Api\Domain\Contracts\Repository\ArticleRepositoryInterface;
use Silex\Api\Domain\Entity\Article;


class DoctrinePostRepository extends EntityRepository implements ArticleRepositoryInterface
{

    /**
     * @param $id
     * @return Article
     */
    public function findById($id)
    {
        return $this->find($id);
    }
}