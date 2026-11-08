<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('celsius', NumberType::class, [
                'scale' => 0,
                'html5' => true,
                'input' => 'string',
            ])
            ->add('humidity', IntegerType::class)
            ->add('pressure', IntegerType::class)
            ->add('condition', TextType::class, [
                'empty_data' => '',
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => function (Location $location): string {
                    return $location->getCity() . ', ' . $location->getCountry();
                },
                'placeholder' => 'Select a location',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
