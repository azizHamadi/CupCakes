<?php

namespace CupCakesBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\FloatType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomFor')
            ->add('longitude')
            ->add('atitude')
            ->add('descriptionFor',CKEditorType::class, array('attr' => array('style' => 'width: 800px ; height : 500px')))
            ->add('dateFor' , \Symfony\Component\Form\Extension\Core\Type\DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ) )
            ->add('idTypeFor', EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\TypeFormation',
                'choice_label' => 'nomTypeFor',
                'multiple' => false
            ))
            ->add('imageForm',FileType::class)
            ->add('ajouter_formation', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_formation_type';
    }
}
