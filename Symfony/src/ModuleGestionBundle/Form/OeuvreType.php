<?php

namespace ModuleGestionBundle\Form;

use ModuleGestionBundle\Entity\Emplacement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OeuvreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('genFlashcode')
            ->add('etat', ChoiceType::class, array(
                'choices' => array(
                    'Pas livré' => 'Pas livré',
                    'Livré'     => 'Livré',
                    'En cours'  => 'En cours',
                ),
                'multiple' => false,
                'expanded' => true))
            ->add('emplacements', TextType::class, array(
                'label' => 'Position'))
            ->add('artiste', EntityType::class, array(
                'class' => 'ModuleGestionBundle:Artiste',
                'label' => false,
                'choice_label' => 'nom',))
            ->add('expositions', EntityType::class, array(
                'class' => 'ModuleGestionBundle:Exposition',
                'label' => false,
                'choice_label' => 'nomExposition',))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModuleGestionBundle\Entity\Oeuvre'
        ));
    }
}
