<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 21/11/17
 * Time: 15:13
 */

namespace Silex\Api\Domain\Entity;

/**
 * Class Post
 * @package Silex\Api\Domain\Entity
 * @Entity(repositoryClass="Silex\Api\Domain\Repository\DoctrineArticleRepository")
 * @HasLifecycleCallbacks
 * @Table(name="article")
 */
class Article
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
     * @var string
     * @Column(type="text",nullable=false)
     */
    private $slug;

    /**
     * @var string
     * @Column(type="string",length=255,nullable=false)
     */
    private $image;

    /**
     * @var string
     * @Column(type="text",nullable=false)
     */
    private $body;

    /**
     * @var string
     * @Column(type="text",nullable=false)
     */
    private $tag;

    /**
     * @var string
     * @Column(type="text", name="meta_keyword",nullable=false)
     */
    private $metaKeyword;

    /**
     * @var string
     * @Column(type="text",name="meta_description",nullable=false)
     */
    private $metaDescription;

    /**
     * @var int
     * @Column(type="integer",nullable=false)
     */
    private $status;

    public function getId()
    {
        return $this->id;
    }

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

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * @param $metaKeyword
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }






}