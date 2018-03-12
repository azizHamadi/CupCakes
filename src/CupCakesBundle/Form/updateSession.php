<?php

namespace CupCakesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class updateSession extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebSes', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'
            ) )
            ->add('dateFinSes', DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd'
            ) )
            ->add('capaciteSes')
            ->add('prix')
            ->add('idFor', EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\Formation',
                'choice_label' => 'nomFor',
                'multiple' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundleupdate_session';
    }
}
