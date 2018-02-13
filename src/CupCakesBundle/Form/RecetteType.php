<?php

namespace CupCakesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomRec')
            ->add('idCatRec', EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\CategorieRec',
                'choice_label' => 'nomCatRec',
                'multiple' => false
            ))
            ->add('descriptionRec', TextareaType::class, array('attr' => array('style' => 'width: 500px ; height : 500px')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_recette_type';
    }
}
