<?php

namespace ModuleGestionBundle\Form;

 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TelephoneType extends AbstractType
{
	
   	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('numero', TextType::class)
            ->add('libelle', TextType::class);
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