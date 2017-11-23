<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 22/11/17
 * Time: 16:49
 */

namespace Silex\Api\Domain\Entity;

/**
 * Class Category
 * @package Silex\Api\Domain\Entity
 * @Entity(repositoryClass="Silex\Api\Domain\Repository\DoctrineCategoryRepository")
 * @HasLifecycleCallbacks
 * @Table(name="category")
 */
class Category
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
     * @Column(type="string",length=255,name="name_category",nullable=false)
     */
    private $nameCategory;

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
    public function getNameCategory()
    {
      return $this->nameCategory;
    }

    /**
     * @param $nameCategory
     */
    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;
    }

}