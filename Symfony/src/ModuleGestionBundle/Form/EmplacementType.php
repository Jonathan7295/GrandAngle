<?php

namespace ModuleGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EmplacementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', TextType::class, array(
                'label' => 'Position',
                'attr' => array(
                    'class' => 'form-control ajust')))
            ->add('oeuvre', EntityType::class, array(
                                                'class' => 'ModuleGestionBundle:Oeuvre',
                                                'choice_label' => 'nom',
                                                'expanded' => false,
                                                'required'    => true,
                                                'multiple' => false
                                                ));
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModuleGestionBundle\Entity\Emplacement'
        ));
    }
}
