<?php

namespace CupCakesBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class updateFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomFor')

            ->add('descriptionFor',CKEditorType::class, array(
                    'attr' => array('style' => 'width: 800px ; height : 500px'))
            )
            ->add('dateFor' , DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ) )
            ->add('idTypeFor', EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\TypeFormation',
                'choice_label' => 'nomTypeFor',
                'multiple' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundleupdate_formation';
    }
}
