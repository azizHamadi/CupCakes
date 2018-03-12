<?php

namespace CupCakesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinePromoSesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDeb',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('widget'=>'single_text','format'=>'yyyy-MM-dd'))
            ->add('dateFin',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('widget'=>'single_text','format'=>'yyyy-MM-dd'))
            ->add('idPromo',EntityType::class, array(
                'class'=>"CupCakesBundle\Entity\Promotion",
                'choice_label'=>"tauxPromo",
                'multiple'=>false
            ))
            ->add('idSes',EntityType::class, array(
                'class'=>"CupCakesBundle\Entity\Session",
                'choice_label'=>"nomSes",
                'multiple'=>false
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CupCakesBundle\Entity\LinePromoSes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cupcakesbundle_linepromoses';
    }


}
