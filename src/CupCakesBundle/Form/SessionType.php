<?php

namespace CupCakesBundle\Form;

use CupCakesBundle\Repository\formationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
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
            ->add('imageSess',FileType::class)
            ->add('capaciteSes')
            ->add('nomSes')
            ->add('prix')
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                $projet = $event->getData();
                $event->getForm()->add('idFor', EntityType::class, array(
                    'class' => 'CupCakesBundle\Entity\Formation',
                    'choice_label' => 'nomFor',
                    'query_builder' => function (FormationRepository $formation) use ($projet) {
                        dump($projet->getIdFor()->getIdUser());
                        return $formation->SelectFormationByidUSerCombo($projet->getIdFor()->getIdUser());
                    },
                    'multiple' => false
                ));
            })

            ->add('confirmation', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'cup_cakes_bundle_session_type';
    }
}
