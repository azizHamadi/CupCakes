<?php

namespace CupCakesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProd')
            ->add('qteStockProd')
            ->add('typeProd')
            ->add('prixProd')
            ->add('etatProd')
            ->add('idCat',EntityType::class, array(
                'class' => 'CupCakesBundle\Entity\Categorie',
                'choice_label' => 'nomCat',
                'multiple' => false
            ))
        ->add('imageProd',FileType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CupCakesBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cupcakesbundle_produit';
    }


}
