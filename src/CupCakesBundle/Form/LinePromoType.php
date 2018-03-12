<?php

namespace CupCakesBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinePromoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDeb',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('widget'=>'single_text','format'=>'yyyy-MM-dd'))
            ->add('dateFin',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('widget'=>'single_text','format'=>'yyyy-MM-dd'))
            /*->add('dateDeb',DateTimeType::)
            ->add('dateFin',TextType::class)*/
            ->add('idProd', EntityType::class, array(
                    'class'=>"CupCakesBundle\Entity\Produit",
                    'choice_label'=>"nomProd",
                    'multiple'=>false)
            )
            ->add('idPromo', EntityType::class, array(
                'class'=>"CupCakesBundle\Entity\Promotion",
                'choice_label'=>"tauxPromo",
                'multiple'=>false
                ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CupCakesBundle\Entity\LinePromo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cupcakesbundle_linepromo';
    }


}
