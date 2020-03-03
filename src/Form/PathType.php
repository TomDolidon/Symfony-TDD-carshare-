<?php

namespace App\Form;

use App\Entity\Path;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PathType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seats')
            ->add('startTime')
            ->add('startLocation')
            ->add('endLocation')
            ->add('driver')
            ->add('passengers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Path::class,
        ]);
    }
}
