<?php

namespace CupCakesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProd')
            ->add('qteStockProd')
            ->add('typeProd')
            ->add('prixProd')
            ->add('idCat',EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\Categorie',
                'choice_label' => 'nomCat',
                'multiple' => false
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_update_type';
    }
}
