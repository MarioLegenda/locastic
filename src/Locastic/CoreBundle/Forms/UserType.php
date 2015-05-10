<?php

namespace Locastic\CoreBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)  {
        $builder
            ->add('name', 'text')
            ->add('lastname', 'text')
            ->add('username', 'email')
            ->add('password', 'password')
            ->add('passRepeat', 'password')
            ->add('save', 'submit', array('label' => 'Register'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Locastic\CoreBundle\Entity\User',
        ));
    }

    public function getName() {
        return 'RegistrationForm';
    }
} 