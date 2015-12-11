<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text',array(
		'attr' =>array('class' => 'form-control','placeholder' => 'Votre Nom'),
		'label' => false
		));
        $builder->add('email', 'email',array(
		'attr' =>array('class' => 'form-control','placeholder' => 'Votre Email'),
		'label' => false
		));
        $builder->add('subject','text',array(
		'attr' =>array('class' => 'form-control','placeholder' => 'Sujet'),
		'label' => false
		));
        $builder->add('body', 'textarea',array(
		'attr' =>array('class' => 'form-control','placeholder' => 'Votre Texte'),
		'label' => false		
		));
	$builder->add('capcha', 'text',array(
		'attr' =>array('class' => 'form-control','placeholder' => 'Quel jour de la semaine sommes nous?'),
		'label' => false		
		));
	
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'front_frontbundle_contact';
    }
}