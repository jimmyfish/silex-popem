<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 23/11/17
 * Time: 12:46
 */

namespace Silex\Api\Domain\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TagForm extends AbstractType
{

    private $nameCategory;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'nameCategory',
            'text',
            [
                'constraints' => new Assert\NotBlank(),
                'label' => false,
                'attr' => ['class' => 'form-control','placeholder' => 'input name category', 'required' => 'required']
            ]
        )->add(
            'kirim',
            'submit',
            [
                'attr' => ['class' => 'btn btn-primary btn-block btn-flat']
            ]
        );
    }

    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;
    }

}