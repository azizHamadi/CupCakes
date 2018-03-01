<?php

namespace CupCakesBundle\Form;

use CupCakesBundle\Entity\Recette;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('imageRec',FileType::class,array('data_class' => null))
            ->add('descriptionRec', CKEditorType::class, array('attr' => array('style' => 'width: 992px ; height : 300px')));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Recette::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_recette_type';
    }
}
