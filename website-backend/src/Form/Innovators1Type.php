<?php

namespace App\Form;

use App\Entity\Innovators;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Innovators1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('company')
            ->add('sector')
            ->add('innovation')
            ->add('impact')
            ->add('funding')
            ->add('image_url')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Innovators::class,
        ]);
    }
}
