<?php

namespace CupCakesBundle\Form;


use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomRec')
            ->add('idCatRec', EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\CategorieRec',
                'choice_label' => 'nomCatRec',
                'multiple' => false
            ))
            ->add('descriptionRec', CKEditorType::class, array('attr' => array('style' => 'width: 992px ; height : 300px')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_recette_update_type';
    }
}
