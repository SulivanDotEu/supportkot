<?php

namespace Walva\SupportkotBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Walva\SupportkotBundle\Entity\Annee;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom')
                ->add('couleur', 'choice', array(
                    'choices' => array(
                        Annee::$COULEUR_BLEU => 'Bleu',
                        Annee::$COULEUR_GRIS => 'Gris',
                        Annee::$COULEUR_ORANGE => 'Orange',
                        Annee::$COULEUR_NOIR => 'Noir',
                        Annee::$COULEUR_ROUGE => 'Rouge',
                        Annee::$COULEUR_VERT => 'Vert',
                    ),
                    'required' => true,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Walva\SupportkotBundle\Entity\Fac'
        ));
    }

    public function getName() {
        return 'walva_supportkotbundle_factype';
    }

}
