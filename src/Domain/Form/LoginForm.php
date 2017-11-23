<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 21/11/17
 * Time: 13:07
 */

namespace Silex\Api\Domain\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LoginForm extends AbstractType
{

    private $username;

    private $password;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username',
            'text',
            [
                'constraints' => new Assert\NotBlank(),
                'label' => false,
                'attr' => ['class' => 'form-control','placeholder' => 'input username','required' => 'required'],
                'label_attr' => ['class' => 'field-label']
            ]
        )->add(
            'password',
            'password',
            [
                'constraints' => new Assert\NotBlank(),
                'label' => false,
                'attr' => ['class' => 'form-control','placeholder' => 'input password'],
                'label_attr' => ['class' => 'field-label']
            ]
        )->add(
            'kirim',
            'submit',
            [
                'attr' => ['class' => 'btn btn-primary btn-block btn-flat'],
                'label' => 'eksekusi'
            ]
        );
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}