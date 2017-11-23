<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 21/11/17
 * Time: 17:12
 */

namespace Silex\Api\Domain\Contracts\Repository;


use Silex\Api\Domain\Entity\Article;

interface ArticleRepositoryInterface
{

    /**
     * @param $id
     * @return Article
     */
    public function findById($id);

}