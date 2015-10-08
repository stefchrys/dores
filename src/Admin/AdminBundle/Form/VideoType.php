<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur')
            ->add('titre')
            ->add('source','file', array('data_class' => null,'required' => false))
            ->add('categorie','choice',array(
                'choices' => array('cat1' => 'cat1', 'cat2' => 'cat2', 'cat3' =>'cat3')
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\AdminBundle\Entity\Video'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_adminbundle_video';
    }
}
