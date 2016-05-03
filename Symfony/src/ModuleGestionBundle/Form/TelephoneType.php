<?php

namespace ModuleGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TelephoneType extends AbstractType
{
	
   	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('numero', TextType::class, array('label' => 'Numero'), 'attr', array('class' => 'form-control'))
            ->add('libelle', TextType::class, array('label' => 'Libellé'), 'attr', array('class' => 'form-control'));
    }

	/**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModuleGestionBundle\Entity\Telephone'
        ));
    }
}