<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 23/11/17
 * Time: 14:23
 */

namespace Silex\Api\Domain\Entity;

/**
 * Class Page
 * @package Silex\Api\Domain\Entity
 * @Entity(repositoryClass="Silex\Api\Domain\Repository\DoctrinePageRepository")
 * @HasLifecycleCallbacks
 * @Table(name="page")
 */
class Page
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
    private $title;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}