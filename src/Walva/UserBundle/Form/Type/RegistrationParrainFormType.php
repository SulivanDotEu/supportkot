<?php

namespace Walva\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Walva\SupportkotBundle\Form\ParrainType;
use Walva\SupportkotBundle\Form\FilleulType;

class RegistrationParrainFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('parrain', new ParrainType(), array('label' => false));
        $builder->add('filleul', new FilleulType(), array('label' => false));
        $builder->remove('username');
    }
    
    public function getName()
    {
        return 'walva_user_registration';
    }
   
}



?>
