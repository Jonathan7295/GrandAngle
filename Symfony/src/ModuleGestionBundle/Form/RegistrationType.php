<?php

namespace ModuleGestionBundle\Form;

 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegistrationType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('firstname', TextType::class, array('label' => 'Nom'))
            ->add('lastname', TextType::class, array('label' => 'Prénom'))
            ->add('telephones', CollectionType::class, array(
                    'entry_type' =>'ModuleGestionBundle\Form\TelephoneType'))
            ->add('role', ChoiceType::class, array(
                  'choices' => array(
                      'Administrateur' => 'ROLE_ADMIN',
                      'Utilisateur' => 'ROLE_USER',
                      ),
                ),
                array('attr' => array('class' => 'roleEdit')));
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