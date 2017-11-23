<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 23/11/17
 * Time: 12:52
 */

namespace Silex\Api\Domain\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostForm extends AbstractType
{

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var int
     */
    private $status;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            'text',
            [
                'constraints' => new Assert\NotBlank(),
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'input title',
                    'required' => 'required'
                ]
            ]
        )->add(
            'image',
            'file',
            [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Image(['maxSize' => '1m'])
                ]
            ]
        )->add(
            'body',
            'text',
            [
                'constraints' => new Assert\NotBlank(),
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'input text body',
                    'required' => 'required'
                ]
            ]
        )->add(
            'tag',
            'text',
            [
                'constraints' => new Assert\NotBlank(),
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'required' => 'required'
                ]
            ]
        )->add(
            'kirim',
            'submit',
            [
                'attr' => [
                    'class' => 'btn btn-primary btn-block btn-flat'
                ]
            ]
        );
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
        return $this->body = $body;
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

}