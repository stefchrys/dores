<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LivresType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('premiere','checkbox',array('required' => false))
            ->add('auteur')
            ->add('titre')
            ->add('sousTitre','textarea')
            ->add('collection','choice',array(
                'choices' => array('XIX eme' => 'XIX eme', 'Litterature' => 'Littérature', 'Essais' =>'Essais')
                ))
            ->add('categorie','choice',array(
                'choices' => array('Roman' => 'Roman', 'Theatre' => 'Théatre', 'Poesie' =>'Poésie','null'=>null)
                ))
            ->add('prix')
            ->add('image','file', array('data_class' => null,'required' => false))
            ->add('synopsis')
            ->add('preface')
            ->add('footer')
	    ->add('paypal')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\AdminBundle\Entity\Livres'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_adminbundle_livres';
    }
}
