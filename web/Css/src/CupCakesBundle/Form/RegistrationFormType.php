<?php

namespace CupCakesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phoneNumber')
            ->add('addresse')
            ->add('roles',ChoiceType::class,array(
                'label'=>'Role',
                'choices'=>array(
                    'Patisserie'=>'ROLE_PATISSERIE',
                    'Formateur'=>'ROLE_FORMATEUR',
                    'Client'=>'ROLE_CLIENT'
                ),
                'required'=>true,
                'multiple'=>true
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType' ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_registration_form_type';
    }
}
