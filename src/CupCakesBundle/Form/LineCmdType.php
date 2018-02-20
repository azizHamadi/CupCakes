<?php

namespace CupCakesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LineCmdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idCmd', EntityType::class,array(
                'class'=>'CupCakesBundle\Entity\Commande',
                'choice_label'=>'id',
                'multiple'=>false
            ))
            ->add('idProd',EntityType::class, array (
                'class'=> 'CupCakesBundle\Entity\Produit',
                'choice_label'=>'id',
                'multiple'=>false
            ))
            ->add('qteAcheter')
            ->add('etatLineCmd')
            ->add('ajouter',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_line_cmd_type';
    }
}
