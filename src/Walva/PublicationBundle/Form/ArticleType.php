<?php

namespace Walva\PublicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Walva\PublicationBundle\Entity\Image;

class ArticleType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateCreation')
                
                ->add('titre')
                ->add('slug')
                ->add('resume')
                ->add('contenu')
                ->add('categorie')
                ->add('published')
                ->add('epingle')
               
                //->add('image', new ImageType(), array('required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Walva\PublicationBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'walva_hafbundle_article';
    }

}
