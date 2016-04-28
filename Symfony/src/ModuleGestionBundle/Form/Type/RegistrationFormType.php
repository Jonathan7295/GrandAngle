<?php
namespace ModuleGestionBundle\Form;
 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         parent::buildForm($builder, $options);
        
        $builder
            ->add('firstname','text',array('label' => 'Nom'))
            ->add('lastname','text',array('label' => 'Prenom'))
        ;
    }
}