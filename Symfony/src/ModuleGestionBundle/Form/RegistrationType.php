<?php

namespace ModuleGestionBundle\Form;

 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('firstname', TextType::class, array('label' => 'Nom'))
            ->add('lastname', TextType::class, array('label' => 'Prénom'))
            ->add('locked', CheckboxType::class, array('required' => false))
            ->add('role', ChoiceType::class, array(
                  'choices' => array(
                      'Sélectionnez' => 'INDEFINI',
                      'Utilisateur' => 'USER',
                      'Administrateur' => 'ADMIN',
                      ),
                ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModuleGestionBundle\Entity\Utilisateur'
        ));
    }

    public function getParent()
    {
    	return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
    	return 'app_user_registration';
    }

    public function getName()
    {
    	return $this->getBlockPrefix();
    }
}